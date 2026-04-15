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

        $keys = [
            'home_hero',
            'home_carousel',
            'home_features',
            'home_services',
            'home_stats',
            'home_faq'
        ];

        $homeSettings = [];
        foreach ($keys as $key) {
            $value = setting($key);
            $homeSettings[$key] = $value ? json_decode($value, true) : \App\Models\Setting::getHomeDefaults($key);
        }

        return Inertia::render('Home', [
            'homeSettings' => $homeSettings,
            'projects' => ProjectResource::collection($projects)
        ]);
    }
}
