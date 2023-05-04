<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\SubTask;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    public function store($type, $type_id, Request $request)
    {
        $alias_lookup = [
            'todo' => 'App\Models\Todo',
            'subtask' => 'App\Models\SubTask'
        ];
        $model = $alias_lookup[$type]::findOrFail($type_id);

        $model->subTasks()->create([
            'body' => $request->body,
            'is_task' => $request->is_task
        ]);

        return response()->json([], 201);
    }
}
