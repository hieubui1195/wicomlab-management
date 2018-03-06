<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Task;
use App\Models\TaskPerformer;
use App\Models\ProjectMember;
use App\Models\File;
use App\Models\User;

class Project extends Model
{
    use SoftDeletes;

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class);
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
