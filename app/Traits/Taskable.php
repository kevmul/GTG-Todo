<?php

namespace App\Traits;

use App\Models\SubTask;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Taskable
{
    public function subTasks(): MorphMany
    {
        return $this->morphMany(SubTask::class, 'taskable');
    }
}
