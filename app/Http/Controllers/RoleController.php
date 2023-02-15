<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
class RoleController extends Controller
{

    public function __construct()
    {
       // $this->middleware('can:create role')->only('create');
    }


    public function index()
    {
        return  Role::get();        
    }

    public function attachUserRole($userId,$role)
    {
        $user = User::find($userId)->first();
        $roleId =  Role::where('name',$role)->first();
        $user->roles()->attach($roleId);
        return $user;       
    }

    public function getUserRole($userId)
    {
        return User::find($userId)->roles;
    }

    public function attachPermission(Request $request)
    {
        $parameters = $request->only('permission','role');
        $permissionParam = $parameters['permission'];
        $roleParam = $parameters['role'];
       
        $role = Role::where('name',$roleParam)->first();
        $permission = Permission::where('name',$permissionParam)->first();
        $role->attachPermission($permission);
        return $this->response()->json()->created();
    }

    public function getPermissions($roleParam){
        $role = Role::where('name',$roleParam)->first();
        return response()->json()->array($role->perms);
    }

    public function store(Request $request)
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
}
