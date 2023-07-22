<?php

namespace App\Models;

use App\Models\Scopes\ArchiveScope;
use App\Traits\Taskable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory, Taskable;

    protected $fillable = ['title', 'completed_at'];

    protected static function booted(): void
    {
        static::addGlobalScope(new ArchiveScope);
    }

    /*|========================================================
     | Methods
    |========================================================*/

    public function markProgress($progress)
    {
        $this->progress = $progress;
        $this->update();
    }

    public function archive()
    {
        $this->archived_at = now();
        $this->update();
    }

    /*|========================================================
     | Relationships
    |========================================================*/

    /*|========================================================
     | Query Scopes
    |========================================================*/

    public function scopeArchived($query): void
    {
        $query->withoutGlobalScope(ArchiveScope::class)
            ->whereNotNull('archived_at');
    }

    /*|========================================================
     | Attributes
    |========================================================*/

    public function getIsCompleteAttribute()
    {
        return $this->progress === 'complete';
    }
}
