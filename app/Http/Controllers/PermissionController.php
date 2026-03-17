<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function permission_create()
    {
        return view('permissions.create');
    }

    public function permission_store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create([
            'name' => strtolower(trim($request->name))
        ]);

        return redirect()->back()->with('success', 'Permission created successfully');
    }
}

