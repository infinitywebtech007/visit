<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $employees = Employee::with('user')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        // Create user with name and email
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt('password'), // default password, should be changed later
        ]);
        
        $role= Role::findByName('employee');
        $user->assignRole($role);

        // Create employee linked to user
        $employee = new Employee();
        $employee->position = $validated['position'];
        $employee->phone = $validated['phone'];
        $employee->address = $validated['address'] ?? null;
        $employee->status = $validated['status'] ?? 'active';
        $employee->user_id = $user->id;
        $employee->profile_photo_path = $validated['profile_photo_path'] ?? null;
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load('user');
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->load('user');
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        // Update user info
        $employee->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update employee info
        $employee->position = $validated['position'];
        $employee->phone = $validated['phone'];
        $employee->address = $validated['address'] ?? null;
        $employee->status = $validated['status'] ?? 'active';
        if (isset($validated['profile_photo_path'])) {
            $employee->profile_photo_path = $validated['profile_photo_path'];
        }
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Delete user will cascade delete employee due to foreign key constraint
        $employee->user->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
