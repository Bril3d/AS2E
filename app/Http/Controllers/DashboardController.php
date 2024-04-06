<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function getNewUsersByMonth()
    {
        $newUsersByMonth = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $newUsersByMonth->pluck('month')->toArray();
        $data = $newUsersByMonth->pluck('total')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'New Users',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                    'data' => $data,
                ],
            ],
        ];
    }

    public function stats()
    {
        $totalUsers = User::count();
        $totalDates = Appointment::count();
        $newUsersByMonth = $this->getNewUsersByMonth();

        return Inertia::render('Dashboard', ['users' => $totalUsers, 'dates' => $totalDates, 'usersByMonth' => $newUsersByMonth]);
    }
}
