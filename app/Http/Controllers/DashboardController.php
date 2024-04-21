<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Comment;
use App\Models\LikedPost;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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


    public function getLikesByMonth(Request $request)
{
    // Get the authenticated user
    $user = $request->user();

    // Get the posts created by the authenticated user
    $userPosts = $user->posts();

    // Get the IDs of the user's posts
    $userPostIds = $userPosts->pluck('id');

    // Query the liked posts table and count likes on the user's posts
    $newLikesByMonth = LikedPost::whereIn('post_id', $userPostIds)
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Initialize an array to hold the counts for each month, starting with zeros
    $monthCounts = array_fill(1, 12, 0);

    // Populate the $monthCounts array with actual counts
    foreach ($newLikesByMonth as $like) {
        $monthCounts[$like->month] = $like->total;
    }

    // Get the names of all months
    $labels = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Initialize an array to hold the data for each month
    $data = [];

    // Fill in the data array with actual counts or zeros for each month
    foreach ($labels as $index => $monthName) {
        $data[] = $monthCounts[$index + 1]; // Adding 1 because months are 1-indexed in MySQL
    }

    return [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Likes Per Month',
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
                'data' => $data,
            ],
        ],
    ];
}

    public function stats(Request $request)
    {

        if ($request->user()->isLeader()) {

            $today = Carbon::now();

            $totalUsers = User::count();
            $totalPosts = Post::count();
            $totalDates = Appointment::where('end', '<=', $today)->count();

            $newUsersByMonth = $this->getNewUsersByMonth();

            return Inertia::render('Dashboard/Leaders', ['stats' => ['users' => $totalUsers, 'posts' => $totalPosts, 'dates' => $totalDates], 'usersByMonth' => $newUsersByMonth]);
        } else {
            $user = $request->user();

            $totalPosts = Post::where('user_id', $user->id)->count();
            $totalComments = Comment::where('user_id', $user->id)->count();

            $newLikesByMonth = $this->getLikesByMonth($request);

            return Inertia::render('Dashboard/Users', ['stats' => ['comments' => $totalComments, 'posts' => $totalPosts], 'likes' => $newLikesByMonth]);
        }
    }
}
