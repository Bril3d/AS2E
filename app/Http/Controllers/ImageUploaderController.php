<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploaderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $projectImage = '';
        if ($request->wantsJson()) {
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => ['required', 'image', 'max:1024', 'mimes:jpg,jpeg,png'],
                ]);
                $projectImage = $request->file('image')->store('project-images', 'public');

                return '/storage/' . $projectImage;
            }
        }

        return back()->with('message', 'Not Uploaded');
    }
}
