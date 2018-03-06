<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = DB::table('project_members')
                        ->join('projects', 'project_members.project_id', '=', 'projects.id')
                        ->join('users', 'project_members.user_id', '=', 'users.id')
                        ->select('users.name', 'projects.project', 'projects.begin', 'projects.end', 'project_members.user_id', 'project_members.project_id', 'project_members.position')
                        ->where('project_members.position', 1)
                        ->get();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('project.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project;
        $project->project = $request->project;
        $project->user_id = $request->manager;
        $project->begin = $request->begin;
        $project->end = $request->end;
        $project->save();
        return redirect()->route('project.index')->with(['msg' => 'Add new project successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $manager = DB::table('project_members')
                        ->where('project_id', $id)
                        ->where('position', 1)
                        ->pluck('user_id');
        $tasks = Project::find($id)->tasks;
        Session::put('project_id', $id);
        return view('project.show', compact('project', 'manager', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $users = User::all();
        return view('project.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProjectRequest $request, $id)
    {
        $project = Project::find($id);
        $project->project = $request->project;
        $project->user_id = $request->manager;
        $project->begin = $request->begin;
        $project->end = $request->end;
        $project->save();
        return redirect()->route('project.index')->with(['msg' => 'The project has been edited']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.index')->with([
            'msg' => 'The project has been deleted',
        ]);
    }
}
