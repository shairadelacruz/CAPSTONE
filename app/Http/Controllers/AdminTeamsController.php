<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\Role;
use App\Http\Requests;

class AdminTeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teams = Team::all();
        return view('admin.management.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();

        $role = Role::find(2);

        $team_leaders = $role->users->pluck('name','id');
        
        return view('admin.management.team.create', compact('team_leaders','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
        'name' => 'required|unique:teams',
        'team_leader' => 'required',
        'user_id' => 'required',
        ]);


        $newteam = new Team;
        $newteam->name = $request->name;
        $newteam->team_leader = $request->team_leader;
        $newteam->save();

        $users = $request->user_id;

        $teams = Team::all();

        $team = $teams->last();

        $team->users()->sync($users);

        return redirect('/admin/management/team');
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
        //

        $team = Team::findOrFail($id);

        $users = User::all();

        $role = Role::find(2);

        $team_leaders = $role->users->lists('name','id')->all();

        return view('admin.management.team.edit', compact('team','team_leaders','users'));
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
        //
        $this->validate($request, [
        'name' => 'required',
        'team_leader' => 'required',
        'user_id' => 'required',
        ]);

        $team = Team::findOrFail($id);
        $team->name = $request->name;
        $team->team_leader = $request->team_leader;
        $team->update();

        $users = $request->user_id;

        //$team = Team::findOrFail($id);

        //$input = $request->all();

        //$team->update($input);
        $team->users()->detach();

        $team->users()->sync($users);

        return redirect('/admin/management/team');
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
        $team = Team::findOrFail($id);

        $team->delete();

        $team->users()->detach();

        Session::flash('deleted_team','The team has been deleted');

        return redirect('/admin/management/team');
    }
}
