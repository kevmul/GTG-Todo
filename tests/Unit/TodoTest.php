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
        $this->assertEquals($todo->progress, 'new');
        $this->assertFalse($todo->isComplete, 'Todo isCompleted should be False.');

        collect(['new', 'in-progress', 'complete'])->each(function ($progress) use ($todo) {
            $todo->markProgress($progress);
            $this->assertEquals($todo->progress, $progress);

            if ($progress === 'complete') {
                $this->assertTrue($todo->isComplete, 'Todo is not complete');
            } else {
                $this->assertFalse($todo->isComplete, 'Todo is complete');
            }
        });
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
