<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Models\ExperiseProjects;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpertiseResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expertises = Expertise::latest()->paginate(setting('pagination_limit'));

        return Inertia::render('Expertises/Index', ['expertises' => ExpertiseResource::collection($expertises)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $projects = Project::select('id', 'title')->get();

        return Inertia::render('Expertises/Create', [
            "projects" => $projects
        ]);
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

        $expertiseImage = '';
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'max:1024', 'mimes:jpg,jpeg,png'],
            ]);
            $expertiseImage = $request->file('image')->store('expertise-images', 'public');
        }

        $expertise = Expertise::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'image' => $expertiseImage,
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);

        if ($expertise) {

            $expertise->projects()->sync($request->input('projects.*.id'));

            return Redirect::route('expertises.index')->with('success', 'Expertise created successfully.');
        }

        return back()->with('message', 'Expertise could not be created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expertise $expertise)
    {
        return Inertia::render('Expertises/Show', [
            'expertise' => new ExpertiseResource($expertise)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function display($slug)
    {
        $expertise = Expertise::where('slug', $slug)->firstOrFail();

        return Inertia::render('Expertises/Display', [
            'expertise' => new ExpertiseResource($expertise)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expertise $expertise)
    {
        $projects = Project::select('id', 'title')->get();

        return Inertia::render('Expertises/Edit', [
            'expertise' => new ExpertiseResource($expertise),
            'projects' => $projects
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expertise $expertise)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => ['required', 'min:10'],
            'body' => 'required|string',
        ]);

        $expertiseImage = '';
        if ($request->file('image')) {
            $request->validate([
                'image' => ['image', 'max:1024', 'mimes:jpg,jpeg,png'],
            ]);
            if ($expertise->image) {
                Storage::delete($expertise->image);
            }
            $expertiseImage = $request->file('image')->store('expertise-images', 'public');
        }

        $expertise->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $expertiseImage ? $expertiseImage : $expertise->image,
            'body' => $request->body,
        ]);

        $expertise->projects()->sync($request->input('projects.*.id'));

        if ($expertise->wasChanged()) {
            return to_route('expertises.index')->with('success', 'Expertise updated successfully.');
        }

        return to_route('expertises.index')->with('message', 'Something went wrong, please try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expertise $expertise)
    {
        $expertise->delete();

        return back();
    }
}
