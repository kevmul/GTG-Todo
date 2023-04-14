<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /*|========================================================
     | TESTS
    |========================================================*/

    /*|--------------------------------------------------------
     | Creating Todo
    |--------------------------------------------------------*/

    /** @test */
    public function a_todo_can_be_created()
    {
        $response = $this->post(route('todo.store'));

        $this->assertEquals('New Todo', $response['title']);
    }

    /*|--------------------------------------------------------
     | Editing Todo
    |--------------------------------------------------------*/

    /**
     * provider
     */
    public function dataProviderForTitleValidation()
    {
        return [
            // field, value, should_succeed, error_message
            ['title', 'My First TODO!', true, 'Todo with title should succeed.'],
            ['title', '', false, 'The title is required.'],
            ['title', 'ab', false, 'The title must be at least 3 characters.'],
            ['title', implode('', array_fill(0, 100, 'a')), true, 'Title should allow for 100 chars.'],
            ['title', implode('', array_fill(0, 101, 'a')), false, 'The title cannot exceed 100 characters.'],
        ];
    }

    /**
     * @test
     * @dataProvider dataProviderForTitleValidation
     */
    public function it_can_validate_a_todo($field, $value, $should_succeed, $error_message)
    {
        Todo::factory(1)->create(['title' => 'New Todo']);
        $response = $this->patch(route('todo.update', 1), [
            $field => $value
        ]);

        if ($should_succeed) {
            $this->assertMissingValidationError($response, $field, $error_message);
        } else {
            $this->assertHasValidationError($response, $field, $error_message);
        }
    }

    /** @test */
    public function a_todo_can_be_completed()
    {
        Todo::factory()->create(['title' => 'My First Todo!']);

        $response = $this->patch(route('todo.complete', ['todo_id' => 1]));
        $response->assertOk();

        tap(Todo::first(), function ($todo) {
            $this->assertEquals('My First Todo!', $todo->title);
            $this->assertTrue($todo->isCompleted, 'isCompleted is not True.');
        });
    }

    /*|--------------------------------------------------------
     | Viewing Todo
    |--------------------------------------------------------*/

    /** @test */
    public function it_gets_todos_in_desc_order()
    {
        Todo::factory(3)->create();

        $response = $this->getJson('/todos')->getContent();
        $todos = json_decode($response)->todos;

        $this->assertEquals(3, $todos[0]->id);
        $this->assertEquals(2, $todos[1]->id);
        $this->assertEquals(1, $todos[2]->id);
    }

    /** @test */
    public function archived_todos_do_not_show_on_index()
    {
        $todo1 = Todo::factory()->create();
        $todo2 = Todo::factory()->archived()->create();
        $todo3 = Todo::factory()->create();

        $response = $this->getJson('/todos')->getContent();
        $todos = collect(json_decode($response)->todos);

        $this->assertTrue($todos->contains('id', $todo1->id));
        $this->assertTrue($todos->contains('id', $todo3->id));
        $this->assertFalse($todos->contains('id', $todo2->id));
    }

    /*|--------------------------------------------------------
     | Deleting Todo
    |--------------------------------------------------------*/

    /** @test */
    public function it_can_be_archived()
    {
        $todo = Todo::factory()->create();
        $this->assertNull($todo->fresh()->archived_at);
        $response = $this->delete(route('todo.archive', ['todo' => $todo->id]));
        $this->assertNotNull($todo->fresh()->archived_at);
    }
}
