<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Change password form
    public function changePasswordForm()
    {
        return view('users.change_password');
    }
    // Handle password change
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']); 
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('change.password.form')->with('success', 'Password changed successfully');
    }

    function rolesAndPermissions()
    {
        $users = User::with('roles', 'permissions')->get();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('users.roles_permissions', compact('users', 'roles', 'permissions'));
    }
    function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string',
        ]);
        $user = User::find($request->user_id);
        $user->assignRole($request->role);
        return response()->json(['message' => 'Role assigned successfully']);
    }

    function removeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string',
        ]);
        $user = User::find($request->user_id);
        $user->removeRole($request->role);
        return response()->json(['message' => 'Role removed successfully']);
    }
    
    function givePermission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|string',
        ]);
        $user = User::find($request->user_id);
        $user->givePermissionTo($request->permission);
        return response()->json(['message' => 'Permission granted successfully']);
    }

    function removePermission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|string',
        ]);
        $user = User::find($request->user_id);
        $user->revokePermissionTo($request->permission);
        return response()->json(['message' => 'Permission revoked successfully']);
    }

    function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->name]);
        return response()->json(['message' => 'Role created successfully', 'role' => $role]);
    }

    function deleteRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $role = Role::findByName($request->name);
        if ($role) {
            $role->delete();
            return response()->json(['message' => 'Role deleted successfully']);
        }
        return response()->json(['error' => 'Role not found'], 404);
    }

    function addPermissionToRole(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'permission' => 'required|string',
        ]);
        $role = Role::findByName($request->role);
        if ($role) {
            $role->givePermissionTo($request->permission);
            return response()->json(['message' => 'Permission added to role successfully']);
        }
        return response()->json(['error' => 'Role not found'], 404);
    }

    function removePermissionFromRole(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'permission' => 'required|string',
        ]);
        $role = Role::findByName($request->role);
        if ($role) {
            $role->revokePermissionTo($request->permission);
            return response()->json(['message' => 'Permission removed from role successfully']);
        }
        return response()->json(['error' => 'Role not found'], 404);
    }

    function createPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);
        $permission = Permission::create(['name' => $request->name]);
        return response()->json(['message' => 'Permission created successfully', 'permission' => $permission]);
    }

    function deletePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $permission = Permission::findByName($request->name);
        if ($permission) {
            $permission->delete();
            return response()->json(['message' => 'Permission deleted successfully']);
        }
        return response()->json(['error' => 'Permission not found'], 404);
    }

}
