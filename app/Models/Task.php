<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;
use App\Models\TaskPerformer;
use App\Models\Comment;

class Task extends Model
{
    use SoftDeletes;
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function taskPerformers()
    {
    	return $this->hasMany(TaskPerformer::class);
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
}
