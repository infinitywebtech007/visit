<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Visitor;
use App\Models\Employee;
use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

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
        // create new image instance
        // $manager = new ImageManager(Driver::class);
        
        
        $path = storage_path('app/private/visitors/webcam_photo/' . $visit->visitor->photo_url);
        // $image = $manager->read($path); // 800 x 600
        // dd($path,$visit->visitor->photo_url);
        if($visit->visitor->photo_url && file_exists($path)){
            // $image = $manager->make($path); // 800 x 600

            $imageData = base64_encode(file_get_contents($path ?? ''));
            $src = 'data:' . mime_content_type($path) . ';base64,' . $imageData;
        }
        else{
            // $src = asset('images/default_avatar.png');
            $src = '';
        }
        
        // dd($imageData);
        // $image->scaleDown(width: 200); // 200 x 150
        
        // scale down to fixed height
        // $image->scaleDown(height: 300); //  400 x 300
        // echo '<img src="' . $src . '" alt="Description">';   
        $visit->load('visitor', 'employee', 'manager');
        // return view('visits.print', compact('visit'));
        
        $pdf = app('dompdf.wrapper')->loadView('visits.print', compact('visit'), ['src' => $src]);
        return $pdf->stream('visit_' . $visit->id . '.pdf');
    }
}
