<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $settings = Setting::pluck('value', 'key')->toArray();

        if (!$settings) {
            $settings = config('settngs.default');
        }

        return Inertia::render('Settings', ['settings' => $settings]);
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
    public function store(SettingRequest $request)
    {

        $logo = Setting::where('key', 'logo')->first();

        if ($request->hasFile('logo')) {
            $logoName = 'as2e' . '.' . $request->file('logo')->getClientOriginalExtension();

            if ($logo->value) {
                Storage::disk('public')->delete($logo->value);
            }

            $logoPath = $request->file('logo')->storeAs('', $logoName, 'public');

            $logo->update(['value' => $logoPath]);
        }

        foreach ($request->except('logo') as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        Cache::forget('settings');

        return back()->with('success', 'Settings Updated Succussfully');
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
    public function update(SettingRequest $request)
    {
        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        Cache::forget('settings');

        return back()->with('success', 'Settings Updated Succussfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
