<?php

namespace App\Repository;

use App\Models\Task;
use App\Trait\Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use PDOException;

class TaskRepository {

  use Exception;

  protected $model = 'Tasks';

  public function show(int $id): Task|HttpResponseException {
      $task = Task::find($id);
      if (empty($task)) {
        return $this->retornoExceptionErroRequest(false, 'Task não encontrada.', 400, []);
      }
      return $task;
    }

    public function all(): array {
      return Task::all()->toArray();
    }

    public function update (array $oldTask): array|HttpResponseException {
      DB::beginTransaction();
      try {
        $task = $this->show($oldTask['id']);
        $task->update($oldTask);
        DB::commit();
        return $task->toArray();
      } catch ( PDOException $exception ) {
        DB::rollBack();
        return $this->retornoExceptionErroRequest(false, $exception->getMessage(), 400, []);
      }
    }

    public function create(array $task): array|HttpResponseException {
      DB::beginTransaction();
      try{
        $task = Task::create($task);
        DB::commit();
        return $task->toArray();
      } catch (PDOException $exception) {
        DB::rollBack();
        return $this->retornoExceptionErroRequest(false, $exception->getMessage(), 400, []);
      }
    }

    public function delete(int $id): array|HttpResponseException {
      DB::beginTransaction();
      try {
        $task = $this->show($id);
        $task->delete();
        return [];
      } catch (PDOException $exception) {
        DB::rollBack();
        return $this->retornoExceptionErroRequest(false, $exception->getMessage(), 400, []);
      }
    }
}
