<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:create role')->only('create');
    }


    public function index()
    {
        $roles = Role::all();
 
        $permissions = Permission::all();
        return View('add_roles')->with(array('roles'=>$roles,'permissions'=>$permissions));
    }

    public function store(Request $request)
    {
        
        $role_id = $request->role_id;
        $role = Role::find($role_id);
        if(count($role)>0){
            $checkRole = Role::where('id',$role_id)->withCount('permissions')->get()->toArray();
            if($checkRole[0]['permissions_count']>0){
               $role->permissions()->detach();//delete all relationship in role_permission
            }
            $role->permissions()->attach($request->permissions);//add list permissions
            return redirect()->route('home');
             
        }
        return redirect()->route('home');
 
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
