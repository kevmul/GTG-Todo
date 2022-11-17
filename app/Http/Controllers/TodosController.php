<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodosController extends Controller
{
    public function store(TodoRequest $request)
    {
        $todo = Todo::create([
            'title' => $request->title
        ]);
        return $todo;
    }

    public function update(Request $request, $todo_id)
    {
        $todo = Todo::find($todo_id);

        $todo->update([
            'complete' => $request->completed
        ]);

        return response()->json($todo);
    }

    public function complete($todo_id)
    {
        $todo = Todo::find($todo_id);

        $todo->markComplete();

        return response()->json($todo);
    }
}
