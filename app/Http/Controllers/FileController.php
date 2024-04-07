<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $folder = $request->folder ? '/' . $request->folder : '/';

            if ($folder === '/') {
                $files = collect(Storage::disk('public')->files($folder))->filter(function ($file) {
                    return !Str::startsWith(basename($file), '.');
                })->values()->all();
            } else {
                $files = Storage::disk('public')->files('/' . $folder);
            }
    
            $folders = Storage::disk('public')->directories('/' . $folder);
    
            return Inertia::render('FileExplorer', [
                'files' => $files,
                'folders' => $folders
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
    public function destroy(Request $request)
    {

        if ($request->file){
            Storage::disk('public')->delete($request->file);
        }else{
            Storage::disk('public')->deleteDirectory($request->folder);
        }

        return back()->with('succuss','Deleted Succussfully');
    }

    public function delete(Request $request)
    {

        if ($request->file){
            Storage::disk('public')->delete($request->file);
        }else{
            Storage::disk('public')->deleteDirectory($request->folder);
        }

        return back()->with('succuss','Deleted Succussfully');
    }
}
