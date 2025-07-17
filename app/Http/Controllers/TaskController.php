<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Repository\TaskRepository;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function index(int $id): JsonResponse {
        $task = $this->taskRepository->show($id);
        return response()->json([
            'status'  => true,
            'message' => 'Tarefa encontrada com sucesso.',
            'data'    => $task->toArray()
        ], 200);
    }

    public function show(): JsonResponse {
        $tasks = $this->taskRepository->all();
        return response()->json([
            'status'  => true,
            'message' => 'Tarefas encotradas com sucesso.',
            'data'    => $tasks
        ], 200);
    }

    public function update (int $id, TaskUpdateRequest $oldTask): JsonResponse {
        $task = $oldTask->all();
        $task = $this->taskRepository->update($id, $task);
        return response()->json([
            'status'  => true,
            'message' => 'Tarefa atualizada com sucesso.',
            'data'    => $task
        ],200);
    }

    public function create(TaskRequest $task): JsonResponse {
        $task = $task->all();
        $task = $this->taskRepository->create($task);
        return response()->json([
            'status'  => true,
            'message' => 'Tarefa criada com sucesso.',
            'data'    => $task
        ],200);
    }

    public function delete(int $id): JsonResponse {
        $task = $this->taskRepository->show($id);
        $this->taskRepository->delete($task);
        return response()->json([
            'status'  => true,
            'message' => 'Tarefa excluída com sucesso.',
            'data'    => []
        ],200);
    }

}
