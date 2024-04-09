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
    public function index()
    {
        $contents = $this->getContents('/');

        return Inertia::render('FileExplorer', [
            'contents' => $contents,
        ]);
    }

    private function getContents($folderPath)
    {
        $contents = [];
    
        // Get all files in the folder
        $files = Storage::disk('public')->files($folderPath);
        foreach ($files as $file) {
            $contents[] = [
                'type' => 'file',
                'name' => basename($file),
                'path' => $file,
            ];
        }
    
        // Get all subdirectories in the folder
        $directories = Storage::disk('public')->directories($folderPath);
        foreach ($directories as $directory) {
            $contents[] = [
                'type' => 'folder',
                'name' => basename($directory),
                'path' => $directory,
                'contents' => $this->getContents($directory),
            ];
        }
    
        return $contents;
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
    public function update(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,gif,svg,pdf,docx,xlsx|max:2048', // Adjust allowed file types and size as needed
        ]);

        if ($request->hasFile('file')) {
            $request->file('file')->store($request->path, 'public');
            return back()->with('message', 'File uploaded successfully');
        }

        return back()->with('message', 'File upload failed');
    }

    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:jpeg,jpg,png,gif,svg,pdf,docx,xlsx|max:2048',
        ]);
        dd($request);
        if ($request->hasFile('file')) {
            $request->file('file')->store($request->path, 'public');
            return back()->with('succuss', 'File uploaded successfully');
        }

        return back()->with('message', 'File upload failed');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        if ($request->file) {
            Storage::disk('public')->delete($request->file);
        } else {
            Storage::disk('public')->deleteDirectory($request->folder);
        }

        return back()->with('succuss', 'Deleted Succussfully');
    }

    public function delete(Request $request)
    {

        if ($request->file) {
            Storage::disk('public')->delete($request->file);
        } else {
            Storage::disk('public')->deleteDirectory($request->folder);
        }

        return back()->with('succuss', 'Deleted Succussfully');
    }
}
