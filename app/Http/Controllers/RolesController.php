<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::get();
        return view('dashboard.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['read'] = (int)$request['read'] ?? 0;
        $request['write'] = (int)$request['write'] ?? 0;
        $request['delete'] = (int)$request['delete'] ?? 0;
        $request['modify'] = (int)$request['modify'] ?? 0;
        $request['users'] = (int)$request['users'] ?? 0;
        $request['admin'] = (int)$request['admin'] ?? 0;

        dd($request);

        $role = Roles::find($id);
        $role->perm_read = $request->read;
        $role->perm_write = $request->write;
        $role->perm_delete = $request->delete;
        $role->perm_update = $request->modify;
        $role->perm_users = $request->users;
        $role->perm_su = $request->admin;
        dd($role);
        $role->save();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
