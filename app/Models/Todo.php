<?php

namespace App\Models;

use App\Models\Scopes\ArchiveScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'completed_at'];

    protected static function booted(): void
    {
        static::addGlobalScope(new ArchiveScope);
    }

    /*|========================================================
     | Methods
    |========================================================*/

    public function markComplete()
    {
        $this->completed_at = now();
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

    public function getIsCompletedAttribute()
    {
        return !!$this->completed_at;
    }
}
