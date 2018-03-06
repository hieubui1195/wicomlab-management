<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NewTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\TaskPerformer;
use DateTime;
use Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectId = Session::get('project_id');
        $project = Project::find($projectId);
        $users = User::all();
        return view('task.create', compact('project', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewTaskRequest $request)
    {
        $projectId = Session::get('project_id');
        $task = new Task;
        $task->project_id = $projectId;
        $task->task = $request->task;
        $task->begin = $request->begin;
        $task->end = $request->end;
        $task->description = $request->description;
        $task->save();

        $newTaskId = DB::table('tasks')->where('task', $request->task)->value('id');

        foreach ($request->performers as $performer) {
            $taskPerformer = new TaskPerformer;
            $taskPerformer->task_id = $newTaskId;
            $taskPerformer->user_id = $performer;
            $taskPerformer->save();
        }

        return redirect()->route('project.show', ['id' => $projectId])->with(['msg' => 'Add new task successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        $performers = $task->taskPerformers;
        $auth = Auth::user();
        $project = Project::findOrFail($task->project_id);
        $enableEdit = false;
        for ($i=0; $i < count($performers); $i++) { 
            if (Auth::user()->id == $performers[$i]['user_id']) {
                $enableEdit = true;
                break;
            } else {
                continue;
            }
        }
        return view('task.edit', compact('task', 'users', 'performers', 'auth', 'project', 'enableEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $this->validate($request, [
                'task' => 'required',
                'description' => 'required',
                'performers' => 'required',
            ]);
        $task->task = $request->task;
        $task->begin = $request->begin;
        $task->end = $request->end;
        $task->description = $request->description;
        $task->progress = $request->progress;
        $task->remind = $request->remind;

        $task->save();

        // task_performers table
        $performers = $request->performers;
        $oldPerformers = Task::find($id)->taskPerformers;

        $countPerformers = count($performers);
        $countOldPerformers = count($oldPerformers);

        // Create array
        $arrayId = array();
        foreach ($oldPerformers as $oldPerformer) {
            array_push($arrayId, $oldPerformer['id']);
        }

        $arrayOldPerformers = array();
        foreach ($oldPerformers as $oldPerformer) {
            array_push($arrayOldPerformers, $oldPerformer['user_id']);
        }

        $arrayPerformers = array();
        foreach ($performers as $performer) {
            array_push($arrayPerformers, $performer);
        }

        if ($countPerformers == $countOldPerformers) {
            for ($i=0; $i < $countPerformers; $i++) {
                DB::table('task_performers')->where('id', $arrayId[$i])->update(
                        ['user_id' => $arrayPerformers[$i], 'updated_at' => new DateTime]
                );
            }
        }elseif ($countPerformers < $countOldPerformers) {
            // Update -> Delete
            $num = $countOldPerformers - $countPerformers;
            for ($i=0; $i < $countPerformers; $i++) {
                DB::table('task_performers')->where('id', $arrayId[$i])->update(
                        ['user_id' => $arrayPerformers[$i], 'updated_at' => new DateTime]
                );
            }
            for ($i=$countPerformers; $i < $countOldPerformers ; $i++) { 
                DB::table('task_performers')->where('id', $arrayId[$i])->delete();
            }
        }elseif ($countPerformers > $countOldPerformers) {
            // Update -> Insert
            $num = $countPerformers - $countOldPerformers;
            for ($i=0; $i < $countOldPerformers; $i++) {
                DB::table('task_performers')->where('id', $arrayId[$i])->update(
                        ['user_id' => $arrayPerformers[$i], 'updated_at' => new DateTime]
                );
            }
            for ($i=$countOldPerformers; $i < $countPerformers ; $i++) { 
                DB::table('task_performers')->insert(
                    ['task_id' => $id, 'user_id' => $arrayPerformers[$i], 'created_at' => new DateTime, 'updated_at' => new DateTime]
                );
            }
        }

        return redirect()->route('project.show', $task->project_id)->with(['msg' => 'Update task successfull']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Delete task
    public function deleteTask(Request $request){
        Task::where('id',$request->id)->delete();
        TaskPerformer::where('task_id',$request->id)->delete();
        return $request->all();
    }

    // Check complete task
    public function completeTask(Request $request){
        $task = Task::find($request->id);
        $task->id = $request->id;
        $task->progress = 100;
        $task->save();
        return $request->all();
    }
}
