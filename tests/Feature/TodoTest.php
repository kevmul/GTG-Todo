<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_todo_can_be_created()
    {
        $response = $this->post('/todo', [
            'title' => 'My First TODO!'
        ]);

        $this->assertEquals('My First TODO!', $response['title']);
    }

    /** @test */
    public function two_todos_can_be_created()
    {
        $this->post('/todo', [
            'title' => 'My First TODO!'
        ]);
        $this->post('/todo', [
            'title' => 'My Second Todo!'
        ]);

        tap(Todo::orderBy('id', 'desc')->first(), function ($todo) {
            $this->assertEquals('My Second Todo!', $todo->title);
        });
    }

    /** @test */
    public function a_todo_can_be_completed()
    {
        Todo::factory()->create(['title' => 'My First Todo!']);

        $response = $this->patch('todo/1/mark/completed');
        $response->assertOk();

        tap(Todo::first(), function ($todo) {
            $this->assertEquals('My First Todo!', $todo->title);
            $this->assertTrue($todo->isCompleted, 'isCompleted is not True.');
        });
    }

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
        $response = $this->post('/todo', [
            $field => $value
        ]);

        if ($should_succeed) {
            $response->assertStatus(201);
        } else {
            $response->assertStatus(302);
            $response->assertSessionHasErrors($field);
            $this->assertEquals($error_message, session('errors')->get($field)[0]);
        }
    }
}
