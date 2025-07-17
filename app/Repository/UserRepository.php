<?php

namespace App\Repository;

use App\Models\User;
use App\Trait\Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use PDOException;

class UserRepository {

  use Exception;

  protected $model = 'Users';

  public function create(array $user) {
    DB::beginTransaction();
    try {

      $user['password'] = bcrypt($user['password']);
      $user = User::create($user);
      DB::commit();
      return $user;
    } catch (PDOException $exception) {
      DB::rollBack();
      return $this->retornoExceptionErroRequest(false, 'Erro ao criar o usuário. Erro: ' . $exception->getMessage(), 400, []);
    }
  }

  public function find(int $id): User | HttpResponseException {
    $user = User::find($id);
    if (empty($user)) {
      return $this->retornoExceptionErroRequest(false, 'Usuário não cadastrado.', 404, []);
    }
    return $user;
  }

  public function update(int $id, array $user): array | HttpResponseException {
    $userUp = $this->find($id);
    DB::beginTransaction();
    try {

      $userUp->update($user);
      $userUp->save();
      DB::commit();
      return $userUp->toArray();
    } catch (PDOException $exception) {
      DB::rollBack();
      return $this->retornoExceptionErroRequest(false, 'Usuário não atualizado. Erro: ' . $exception->getMessage(), 404, []);
    }
  }
}
