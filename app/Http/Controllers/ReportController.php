<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Employee;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = Visitor::get(['id', 'name']);
        $employees = Employee::get();
        return view('report.index',[
            'visitors' => $visitors,
            'employees' => $employees,
        ]);
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
    public function store(StoreReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }

    function report_by_date(Request $request)
    {
        // dd($request);
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date. ' +1 day'));

        $visits = Visit::whereBetween('created_at', [$from_date, $to_date])->get();
        return view('report.report_by_date', compact('visits'));
        
    }

    function report_by_visitor(Request $request)
    {
        // dd($request);
        $visitor_id = $request->visitor_id;
        $visits = Visit::where('visitor_id', $visitor_id)->get();
        return view('report.report_by_visitor', compact('visits'));
        
    }

    function report_by_employee(Request $request)
    {
        // dd($request);
        $employee_id = $request->employee_id;
        $visits = Visit::where('employee_id', $employee_id)->get();
        return view('report.report_by_employee', compact('visits'));
        
    }
}
