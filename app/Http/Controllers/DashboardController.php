<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function stats()
    {
        $totalUsers = User::count();
        $totalDates = Appointment::count();

        return Inertia::render('Dashboard', ['users' => $totalUsers, 'dates' => $totalDates]);
    }
}
