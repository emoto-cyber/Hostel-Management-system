<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function role_create()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('roles.index', compact('permissions','roles'));
    }

    public function role_store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->view('roles.index')->with('success', 'Role created successfully');
    }

    public function role_edit(request $request,$id){

    $role = Role::with('permissions')->findOrFail($id);


       $permissions = Permission::all(); // ✅ THIS WAS MISSING

    $rolePermissions = $role->permissions->pluck('name')->toArray();

    return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));

    }

    public function role_update(request $request,$id){

     $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::findOrFail($id);



        $role->update([
            'name' => $request->name
        ]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->back()->with('success', 'Role updated successfully');

    }
}

