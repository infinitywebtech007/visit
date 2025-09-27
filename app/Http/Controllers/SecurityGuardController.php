<?php

namespace App\Http\Controllers;

use App\Models\SecurityGuard;
use App\Models\User;
use App\Http\Requests\StoreSecurityGuardRequest;
use App\Http\Requests\UpdateSecurityGuardRequest;
use Spatie\Permission\Models\Role;

class SecurityGuardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $securityGuards = SecurityGuard::with('user')->paginate(10);
        return view('security_guards.index', compact('securityGuards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = SecurityGuard::get(['company'])->unique('company');
        return view('security_guards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSecurityGuardRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt('password'), // Default password, consider changing later
        ]);

        $role= Role::findByName('security-guard');
        $user->assignRole($role);



        SecurityGuard::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'shift' => $validated['shift'] ?? null,
            'photo' => $validated['photo'] ?? null,
            'active' => $validated['active'] ?? 1,
        ]);

        return redirect()->route('security-guards.index')->with('success', 'Security Guard created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SecurityGuard $securityGuard)
    {
        return view('security_guards.show', compact('securityGuard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SecurityGuard $securityGuard)
    {
        return view('security_guards.edit', compact('securityGuard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSecurityGuardRequest $request, SecurityGuard $securityGuard)
    {
        $validated = $request->validated();

        $securityGuard->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $securityGuard->update([
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'shift' => $validated['shift'] ?? null,
            'photo' => $validated['photo'] ?? null,
            'active' => $validated['active'] ?? 1,
        ]);

        return redirect()->route('security-guards.index')->with('success', 'Security Guard updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecurityGuard $securityGuard)
    {
        $securityGuard->delete();
        return redirect()->route('security-guards.index')->with('success', 'Security Guard deleted successfully.');
    }
}
