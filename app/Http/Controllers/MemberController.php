<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommonRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use MyFunctions;
use File;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MyFunctions::changeLanguage();
        $users = User::all()->sortBy(['school', 'organization', 'name']);

        return view('member.index', compact('users', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        MyFunctions::changeLanguage();

        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommonRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('123456');
        $user->level = $request->level;
        $user->save();
        return redirect()->route('member.index')->with(['msg' => 'Add new member successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $teamMemer = $user->teamMember;
        $teamId = $teamMemer['team_id'];
        $team = Team::find($teamId);
        return view('member.show', compact('user', 'team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('member.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = User::find($id);

        if (Input::hasFile('avatar')) {
            $oldFile = $user->avatar;
            File::Delete($oldFile);
            $file = Input::file('avatar');
            $filename = $file->move('storage/images/avatar/', $file->getClientOriginalName());
        } else {
            $filename = $user->avatar;
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->school = $request->school;
        $user->organization = $request->organization;
        $user->course = $request->course;
        $user->avatar = $filename;
        $user->save();
        return redirect()->route('member.show', ['id' => $id])->with(['msg' => 'Update profile successfull']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with(['msg' => 'The member has been deleted']);
    }
}
