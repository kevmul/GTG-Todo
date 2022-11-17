<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'completed_at'];

    /*|========================================================
     | Methods
    |========================================================*/

    public function markComplete()
    {
        $this->completed_at = now();
        $this->update();
    }

    /*|========================================================
     | Relationships
    |========================================================*/

    /*|========================================================
     | Query Scopes
    |========================================================*/

    /*|========================================================
     | Attributes
    |========================================================*/

    public function getIsCompletedAttribute()
    {
        return !!$this->completed_at;
    }
}
