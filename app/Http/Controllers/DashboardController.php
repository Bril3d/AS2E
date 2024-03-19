<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function stats()
    {
        $totalUsers = User::count();

        return Inertia::render('Dashboard', ['users' => $totalUsers]);
    }
}
