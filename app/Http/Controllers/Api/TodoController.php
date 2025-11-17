<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    protected TodoService $todos;

    public function __construct(TodoService $todos)
    {
        $this->todos = $todos;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 15);
        $list = $this->todos->list($request->user(), (int) $perPage);

        return response()->json([
            'status' => 'success',
            'message' => 'Todos retrieved successfully',
            'data' => TodoResource::collection($list),
        ], 200);
    }

    public function store(TodoStoreRequest $request): JsonResponse
    {
        $todo = $this->todos->create($request->user(), $request->only(['title', 'description', 'due_date']));

        return response()->json([
            'status' => 'success',
            'message' => 'Todo created successfully',
            'data' => (new TodoResource($todo))->toArray($request),
        ], 201);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $todo = $request->user()->todos()->find($id);

        if (!$todo) {
            return response()->json(['status' => 'error', 'message' => 'Todo not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Todo retrieved successfully',
            'data' => (new TodoResource($todo))->toArray($request),
        ], 200);
    }

    public function update(TodoUpdateRequest $request, $id): JsonResponse
    {
        try {
            $todo = $this->todos->update($request->user(), (int) $id, $request->only(['title', 'description', 'due_date', 'is_completed']));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Todo not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Todo updated successfully',
            'data' => (new TodoResource($todo))->toArray($request),
        ], 200);
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $this->todos->delete($request->user(), (int) $id);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Todo not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Todo deleted successfully',
        ], 204);
    }

    public function markComplete(Request $request, $id): JsonResponse
    {
        try {
            $todo = $this->todos->markComplete($request->user(), (int) $id);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Todo not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Todo marked as complete successfully',
            'data' => (new TodoResource($todo))->toArray($request),
        ], 200);
    }
}
