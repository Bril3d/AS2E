<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $projects = Project::latest()->limit(3)->get();

        return Inertia::render('Home', [
            'carousel' => Storage::disk('public')->allFiles('carousel'),
            'projects' => ProjectResource::collection($projects)
        ]);
    }
}
