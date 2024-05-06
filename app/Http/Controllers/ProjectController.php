<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(setting('pagination_limit'));

        return Inertia::render('Projects/Index', ['projects' => ProjectResource::collection($projects)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Projects/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'min:10'],
            'body' => ['required', 'min:10'],
        ]);

        $projectImage = '';
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'max:1024', 'mimes:jpg,jpeg,png'],
            ]);
            $projectImage = $request->file('image')->store('project-images', 'public');
        }

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'image' => $projectImage,
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);

        if ($project) {
            return back()->with('success', 'Project created successfully.');
        }

        return back()->with('message', 'Project could not be created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return Inertia::render('Projects/Show', [
            'project' => new ProjectResource($project)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function display($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return Inertia::render('Projects/Display', [
            'project' => new ProjectResource($project)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', ['project' => new ProjectResource($project)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => ['required', 'min:10'],
            'body' => 'required|string',
        ]);

        $projectImage = '';
        if ($request->file('image')) {
            $request->validate([
                'image' => ['image', 'max:1024', 'mimes:jpg,jpeg,png'],
            ]);
            if ($project->image) {
                Storage::delete($project->image);
            }
            $projectImage = $request->file('image')->store('project-images', 'public');
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $projectImage ? $projectImage : $project->image,
            'body' => $request->body,
        ]);

        if ($project->wasChanged()) {
            return to_route('projects.index')->with('success', 'Project updated successfully.');
        }

        return to_route('projects.index')->with('message', 'Something went wrong, please try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return back();
    }
}
