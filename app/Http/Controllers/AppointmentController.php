<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $events = Appointment::all();
        $users = User::orderBy('name')->get();

        return Inertia::render('Appointments/Appointments', ["events" => $events, "users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $assignee = $request->assignee  ? $request->assignee : $assignee = auth()->user()->id;

        $appointment = new Appointment([
            'start' => $request->start,
            'end' => $request->end,
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $assignee
        ]);

        $appointment->save();

        return back()->with('success', 'Imported Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function filter(Request $request)
    {
        if (auth()->user()->isAdmin) {
            return Appointment::whereBetween('start', [$request->start, $request->end])
                ->with('user:id,name,lastname')
                ->get();
        } else {
            return Appointment::whereBetween('start', [$request->start, $request->end])
                ->where('user_id', auth()->user()->id)
                ->get();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $user = auth()->user();
        if ($appointment->user_id === $user->id || $user->isAdmin) {
            $appointment->update($request->all());
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $user = auth()->user();
        if ($appointment->user_id === $user->id || $user->isAdmin) {
            $appointment->delete();
        } else {
            abort(403);
        }
    }
}
