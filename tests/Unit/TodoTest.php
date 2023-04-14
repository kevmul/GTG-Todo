<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Todo;

class TodoTest extends TestCase
{
    /** @test */
    public function a_todo_knows_if_it_is_completed()
    {
        $todo = Todo::factory()->make();
        $this->assertFalse($todo->isCompleted, 'Todo isCompleted should be False.');

        $todo->markComplete();

        $this->assertTrue($todo->isCompleted);
    }

    /** @test */
    public function a_todo_can_be_archived()
    {
        $todo = Todo::factory()->make();
        $this->assertNull($todo->archived_at);
        $todo->archive();
        $this->assertNotNull($todo->archived_at);
    }
}
