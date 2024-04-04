<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
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
        $users = User::select('name', 'id')->orderBy('name')->get();

        return Inertia::render('Appointments/Appointments', ["events" => AppointmentResource::collection($events), "users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $assignee = $request->assignee  ? $request->assignee['id'] : $assignee = auth()->user()->id;

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

        if ($request->has('resize')) {
            $appointment->update($request->except('resize'));
            
            $appointment->save();
        } else {
            $appointment->update($request->except('user_id'));

            $appointment->user_id = $request->user['id'];

            $appointment->save();
        }

        return back()->with('success', 'Appointment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return back()->with('success', 'Appointment Deleted Successfully');
    }
}
