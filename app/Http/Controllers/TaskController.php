<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Response;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends Controller
{
    public function index(): JsonResource {
        return TaskResource::collection(Task::all());
    }

    public function show(Task $task): JsonResource {
        return new TaskResource($task);
    }

    public function store(TaskStoreRequest $request) {
        $request->validated();

        Task::create([
            'uuid' => str()->uuid(),
            ...$request->all()
        ]);

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Task created successfully'
        ], Response::HTTP_CREATED);
    }

    public function update(TaskUpdateRequest $request, Task $task) {
        $request->validated();
        $task->update($request->all());

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Task updated successfully'
        ]);
    }

    public function destroy(Task $task) {
        $task->delete();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Task deleted successfully'
        ]);
    }
}
