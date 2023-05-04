<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use App\Models\SubTask;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubTaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Submit request with current valid params and any overrides
     *
     * @param  Array $overrides
     */
    private function withValidParams($overrides = [])
    {
        return array_merge([
            //
        ], $overrides);
    }

    /*|========================================================
     | TESTS
    |========================================================*/

    /*|--------------------------------------------------------
     | Creating SubTask
    |--------------------------------------------------------*/

    /** @test */
    public function a_todo_can_have_a_subtask()
    {
        $todo = Todo::factory()->create();
        $response = $this->post(route('subtask.store', ['type' => 'todo', 'type_id' => $todo->id]), [
            'body' => 'My first subtask!',
            'is_task' => false
        ]);

        $response->assertStatus(201);

        tap(SubTask::first(), function ($subtask) use ($todo) {
            $this->assertEquals('My first subtask!', $subtask->body);
            $this->assertFalse($subtask->is_task, 'is_task was not false.');
            $this->assertEquals($todo->id, $subtask->taskable_id);
        });
    }

    /** @test */
    public function a_subtask_can_have_a_subtask()
    {
        $todo = Todo::factory()->create();
        $todo->subTasks()->create(SubTask::factory()->make()->toArray());

        $response = $this->post(route('subtask.store', ['type' => 'subtask', 'type_id' => $todo->subTasks()->first()->id]), [
            'body' => 'My first subtask subtask!',
            'is_task' => false
        ]);

        $response->assertStatus(201);

        tap(SubTask::find(1)->subTasks()->first(), function ($subtask) {
            $this->assertEquals('My first subtask subtask!', $subtask->body);
            $this->assertFalse($subtask->is_task);
            $this->assertFalse($subtask->is_task, 'is_task was not false.');
        });
    }

    /*|--------------------------------------------------------
     | Editing SubTask
    |--------------------------------------------------------*/

    /*|--------------------------------------------------------
     | Viewing SubTask
    |--------------------------------------------------------*/

    /*|--------------------------------------------------------
     | Deleting SubTask
    |--------------------------------------------------------*/
}
