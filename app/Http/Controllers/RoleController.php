<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function role_permission_add(){
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        $user_with_role =  User::whereHas('roles')->paginate(3);
        return view('backend.role.role_permission_add', [
            'permissions'=>$permissions,
            'roles'=>$roles,
            'users'=>$users,
            'user_with_role'=>$user_with_role,
        ]);
    }

    function add_permission(Request $request){
        $request->validate([
            'name'=>'required|unique:permissions',
        ]);

       Permission::create([
        'name' => $request->name,
      ]);
      return back()->with('permission_suc', 'Permission Added Successfull');
    }

    function add_role(Request $request){
        $request->validate([
            'role_name' => 'required',
            'permissions' => 'required|array',
        ]);

        $role = Role::create([
            'name' => $request->role_name,
        ]);
        $role->givePermissionTo($request->permissions);
    
        return back()->with('role_suc', 'Role Added Successful');
    }

    function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_name);
        return back()->with('assign_role', 'Role Assign Successful');
    }

    function remove_permission($user_id){
        $user = User::find($user_id);
        $user->syncPermissions([]);
        $user->syncRoles([]);
        return back()->with('remove_role', 'Role Remove Successful');
    }

    function add_indivitual_permission($user_id){
        $user = User::find($user_id);
        $permissions = Permission::all();
        return view('backend.role.indivitual_role_add', [
            'user'=>$user,
            'permissions'=>$permissions,
        ]);
    }

    function update_indivitual_permission(Request $request, $user_id){
        $user = User::find($user_id);
        $user->syncPermissions($request->permissions);
        return back()->with('indivitual_role_add', 'Permission Update Successful');
    }

    function role_edit($role_id){
        $role = Role::find($role_id);
        $permissions = Permission::all();
        return view('backend.role.role_edit', [
            'role'=>$role,
            'permissions'=>$permissions,
        ]);
    }

    function update_role(Request $request, $role_id){
        $role = Role::find($role_id);
        $role->syncPermissions($request->permissions);
        return back()->with('role_update', 'Role Update Successful');
    }
}
