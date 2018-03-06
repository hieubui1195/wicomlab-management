<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;

class File extends Model
{
	use SoftDeletes;
	
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
