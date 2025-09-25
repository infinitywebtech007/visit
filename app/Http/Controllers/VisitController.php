<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Visitor;
use App\Models\Employee;
use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visits = Visit::with('visitor', 'employee')->get();
        return view('visits.index', compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visitors = Visitor::all(); // Only needed fields
        $employees = Employee::with('user:id,name')->get(['id','position','user_id']); // Only needed fields
        return view('visits.create', compact('visitors', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitRequest $request)
    {
        Visit::create($request->validated());
        return redirect()->route('visits.index')->with('success', 'Visit created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        $visit->load('visitor', 'employee');
        return view('visits.show', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        $visitors = Visitor::all();
        $employees = Employee::all();
        return view('visits.edit', compact('visit', 'visitors', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitRequest $request, Visit $visit)
    {
        $visit->update($request->validated());
        return redirect()->route('visits.index')->with('success', 'Visit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('visits.index')->with('success', 'Visit deleted successfully.');
    }

    function print(Visit $visit)
    {
        $visit->load('visitor', 'employee', 'manager');
        // return view('visits.print', compact('visit'));
        $pdf = \PDF::loadView('visits.print', compact('visit'));
        return $pdf->stream('visit_'.$visit->id.'.pdf');    
    }
}
