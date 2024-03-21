<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(15);
        } else {
            $users = User::orderBy("name")->paginate(15);
        }
        return Inertia::render("Users", ["users" => $users]);
    }
}
