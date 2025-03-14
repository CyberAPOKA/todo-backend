<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create(TaskCreateRequest $request): JsonResponse
    {
        $task = $this->taskService->createTask($request->validated());

        return response()->json([
            'message' => 'Tarefa criada com sucesso!',
            'task' => $task
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        $tasks = $this->taskService->getTasks($request->all());

        return response()->json($tasks);
    }

    public function update(TaskUpdateRequest $request, $id): JsonResponse
    {
        $task = Task::findOrFail($id);

        $task->update($request->validated());

        return response()->json([
            'message' => 'Tarefa atualizada com sucesso!',
            'task' => $task
        ]);
    }

    public function delete($id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada.'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Tarefa excluída com sucesso!']);
    }
}
