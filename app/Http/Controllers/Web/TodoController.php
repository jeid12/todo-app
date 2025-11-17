<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TodoService;

class TodoController extends Controller
{
    protected TodoService $todos;

    public function __construct(TodoService $todos)
    {
        $this->todos = $todos;
    }

    public function index(Request $request)
    {
        $list = $this->todos->list($request->user(), 50);

        return view('todos.index', ['todos' => $list]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(\App\Http\Requests\TodoStoreRequest $request)
    {

        $this->todos->create($request->user(), $request->only(['title','description','due_date']));

        return redirect()->route('todos.index')->with('success', 'Todo created');
    }

    public function edit(Request $request, $id)
    {
        $todo = $request->user()->todos()->findOrFail($id);

        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(\App\Http\Requests\TodoUpdateRequest $request, $id)
    {
        $this->todos->update($request->user(), (int)$id, $request->only(['title','description','due_date','is_completed']));

        return redirect()->route('todos.index')->with('success', 'Todo updated');
    }

    public function destroy(Request $request, $id)
    {
        $this->todos->delete($request->user(), (int)$id);

        return redirect()->route('todos.index')->with('success', 'Todo deleted');
    }

    public function complete(Request $request, $id)
    {
        $this->todos->markComplete($request->user(), (int)$id);

        return redirect()->route('todos.index')->with('success', 'Todo marked complete');
    }
}
