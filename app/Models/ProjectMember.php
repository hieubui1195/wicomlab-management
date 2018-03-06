<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;
use App\Models\User;

class ProjectMember extends Model
{
	use SoftDeletes;
	
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
    	return $this->hasOne(User::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Project::class);
    }
}
