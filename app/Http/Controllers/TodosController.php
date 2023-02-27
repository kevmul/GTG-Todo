<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodosController extends Controller
{
    public function index()
    {
        return response()->json([
            'todos' => Todo::orderByDesc('id')->get()
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

    public function complete($todo_id)
    {
        $todo = Todo::find($todo_id);

        $todo->markComplete();

        return response()->json($todo);
    }
}
