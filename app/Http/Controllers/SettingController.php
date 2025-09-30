<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings.index', [
            'settings' => Setting::all(),
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
    public function store(StoreSettingRequest $request)
    {
        Setting::set('print_visit_pass_header', $request->input('print_visit_pass_header','VMS'));

        
        if ($request->print_pass_logo) {
            $request->file('print_pass_logo')->storeAs('print_pass_logo.png');
        }
        return redirect()->route('settings.index')->with('success', 'Settings saved.');
         Setting::set($request->key, $request->value);
         Setting::updateOrInsert(['key' => $request->key], ['value' => $request->value]);
         Setting::getCollection(); // refresh cache
            return redirect()->route('settings.index')->with('success', 'Setting saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
