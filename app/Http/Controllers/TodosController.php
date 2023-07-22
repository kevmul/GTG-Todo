<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoProgressRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodosController extends Controller
{
    public function index()
    {
        return response()->json([
            'todos' => Todo::orderByDesc('id')->with('subtasks', 'subtasks.subtasks', 'subtasks.subtasks.subtasks')->get()
        ]);
    }

    public function store(TodoRequest $request)
    {
        $todo = Todo::create([
            'title' => 'New Todo'
        ]);

        return response()->json([
            'todo' => $todo
        ]);
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update([
            'title' => $request->title
        ]);

        return response()->json([
            'message' => 'Success'
        ], 201);
    }

    public function progress(TodoProgressRequest $request, Todo $todo, $progress)
    {
        $todo->markProgress($progress);

        return response()->json($todo, 201);
    }

    public function archive(Todo $todo)
    {
        $todo->archive();
        return response()->json([
            'message' => "{$todo->title} was archived."
        ]);
    }
}
