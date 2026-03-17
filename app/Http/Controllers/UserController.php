<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function user_create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function user_store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'adm_no'   => 'required|string|unique:users',
            'contact'  => 'required|string|max:20',
            'course'   => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'adm_no'   => $request->adm_no,
            'contact'  => $request->contact,
            'course'   => $request->course,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign role
        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function user_edit($id){
        $roles=Role::all();
        $user=User::findorfail($id);
        return view('users.edit',compact('user','roles'));
    }
   public function user_update(Request $request, $id)
{
    $request->validate([
        'name'     => 'required|string',
        'adm_no'   => 'required|string|unique:users,adm_no,' . $id,
        'contact'  => 'required|string|max:20',
        'course'   => 'required|string',
        'email'    => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6',
        'role'     => 'required'
    ]);

    $user = User::findOrFail($id);

    $user->update([
        'name'    => $request->name,
        'adm_no'  => $request->adm_no,
        'contact' => $request->contact,
        'course'  => $request->course,
        'email'   => $request->email,
    ]);

    // Update password only if provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
        $user->save();
    }

    // Update role properly
    $user->syncRoles([$request->role]);

    return redirect()
        ->route('user.index')
        ->with('success', 'User updated successfully');
}

    public function user_destroy($id){
        $user=User::findorfail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success','User deleted successfully');
}
}

