<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Task;

class TaskPerformer extends Model
{
	use SoftDeletes;
	
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
