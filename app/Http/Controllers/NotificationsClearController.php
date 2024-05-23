<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsClearController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        $user->notifications()->where('read', 0)->update(['read' => 1]);

        return back()->with(['success', 'All Notifications Marked as read']);
    }
}
