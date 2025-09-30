<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Visitor;
use App\Models\Employee;
use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Http\Request;

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
        $employees = Employee::with('user:id,name')->get(['id', 'position', 'user_id']); // Only needed fields
        return view('visits.create', compact('visitors', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitRequest $request)
    {
        if($request->prebooked){
            $request->merge([
                'in_time' => Carbon::parse($request->booking_time)->format('H:i:s'), 
            ]);
        }
        else{
            $request->merge([
                'in_time' => Carbon::now()->format('H:i:s'),
            ]);
        }
        // dd($request->all());
        if($request->prebooked=='1'){
            $in_time= $request->booking_time;
            $visit_date= $request->booking_date;
        }
        else{
            $in_time= Carbon::now()->format('H:i:s');
            $visit_date= Carbon::now()->format('Y-m-d');
        }
        Visit::create([
            'visitor_id' => $request->visitor_id,

            'employee_id' => $request->employee_id,
            'purpose' => $request->purpose,
            'HOD' => $request->HOD,
            'prebooked' => $request->prebooked,
            'visit_date' => $visit_date,
            // 'booking_time' => $request->booking_time,
            'in_time' => $in_time,
            // 'out_time' => $request->out_time,
            'id_proof_number' => $request->id_proof_number,
        ]);
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
        
        $filePath = 'print_pass_logo.png';
        $logo_file=Storage::get($filePath);
        $base64 = base64_encode($logo_file);   
    
        $logo_src = 'data:image/png;base64,' . $base64;   

        
        $path = storage_path('app/private/visitors/webcam_photo/' . $visit->visitor->photo_url);

        if($visit->visitor->photo_url && file_exists($path)){

            $imageData = base64_encode(file_get_contents($path ?? ''));
            $src = 'data:' . mime_content_type($path) . ';base64,' . $imageData;
        }
        else{
            $src = '';
        }

        $visit->load('visitor', 'employee', 'manager');

        $pdf = app('dompdf.wrapper')->loadView('visits.print', compact('visit'), ['src' => $src,'logo_src'=>$logo_src]);
        return $pdf->stream('visit_' . $visit->id . '.pdf');
    }

    public function close(Request $request, Visit $visit)
    {
        $visit->out_time = $request->out_time ?? Carbon::now();
        $visit->save();

        return redirect()->route('visits.index')->with('success', 'Visit closed successfully.');
    }
}
