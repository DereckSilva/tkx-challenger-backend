<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function create(UserRequest $userRequest): JsonResponse {
        $user = $userRequest->all();
        $user = $this->userRepository->create($user);
        return response()->json([
            'status'  => true,
            'message' => 'Usuário criado com sucesso.',
            'data'    => $user->toArray()
        ], 201);
    }

    public function update(int $id, UserUpdateRequest $userUpdateRequest): JsonResponse {
        $user = $userUpdateRequest->all();
        $user = $this->userRepository->update($id, $user);
        return response()->json([
            'status' => true,
            'message' => 'Usuário atualizado com sucesso',
            'data'    => $user
        ], 201);
    }

    public function index(int $id) {
      $user  = $this->userRepository->find($id);
      $tasks = $user->tasks->toArray();
      return response()->json([
        'status'  => true,
        'message' => 'Usuário encontrado com sucesso.',
        'data'    => [
            'user'  => $user->toArray(),
            'tasks' => $tasks
        ]
      ], 200);
    }
}
