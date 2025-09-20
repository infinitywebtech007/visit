<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = Visitor::all();
        return view('visitors.index', compact('visitors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visitors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitorRequest $request)
    {
        $visitor = Visitor::create($request->validated());


        if ($request->filled('webcam_photo')) {
            $data = $request->input('webcam_photo');

            // Extract base64 string (remove "data:image/jpeg;base64,")
            [$type, $data] = explode(';', $data);
            [$blank, $data] = explode(',', $data);

            $decodedImage = base64_decode($data);
            $filename = time() . 'webcam_photo.jpg';
            Storage::put('visitors/webcam_photo/' . $filename, $decodedImage);
            // $path = public_path('uploads/visitors/' . $filename);
            // file_put_contents($path, $decodedImage);
            $visitor->photo_url = $filename;
            $visitor->save();
        }

        if ($request->filled('webcam_id_photo')) {
            $data = $request->input('webcam_id_photo');

            // Extract base64 string (remove "data:image/jpeg;base64,")
            [$type, $data] = explode(';', $data);
            [$blank, $data] = explode(',', $data);

            $decodedImage = base64_decode($data);
            $filename = time() . 'webcam_id_photo.jpg';
            Storage::put('visitors/webcam_id_photo/' . $filename, $decodedImage);
            // $path = public_path('uploads/visitors/' . $filename);
            // file_put_contents($path, $decodedImage);
            $visitor->id_proof_img =  $filename;
            $visitor->save();
        }


        return redirect()->route('visitors.index')->with('success', 'Visitor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitorRequest $request, Visitor $visitor)
    {
        $visitor->update($request->validated());
        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {
        $visitor->delete();
        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }

    public function viewPhoto($filename)
    {
        if (!auth()->check()) abort(403);

        $path = storage_path('visitors/webcam_photo/' . $filename);

        if (!file_exists($path)) abort(404);

        return response()->file($path);
    }

    public function viewID ($filename)
    {
        if (!auth()->check()) abort(403);

        $path = storage_path('visitors/webcam_id_photo/' . $filename);

        if (!file_exists($path)) abort(404);

        return response()->file($path);
    }

    
}
