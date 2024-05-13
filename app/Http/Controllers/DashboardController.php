<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Comment;
use App\Models\LikedPost;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function BarChart($table = 'users')
    {
        $newUsersByMonth = DB::table($table)->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
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

        $user = $request->user();

        $userPosts = $user->posts();


        $userPostIds = $userPosts->pluck('id');

        $newLikesByMonth = LikedPost::whereIn('post_id', $userPostIds)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        $monthCounts = array_fill(1, 12, 0);


        foreach ($newLikesByMonth as $like) {
            $monthCounts[$like->month] = $like->total;
        }


        $labels = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];


        $data = [];


        foreach ($labels as $index => $monthName) {
            $data[] = $monthCounts[$index + 1];
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
        $newLikesByMonth = $this->getLikesByMonth($request);

        if ($request->user()->isLeader()) {

            $today = Carbon::now();

            $totalUsers = User::count();
            $totalProjects = Project::count();
            $totalPosts = Post::count();
            $totalDates = Appointment::where('end', '<=', $today)->count();

            $newUsersByMonth = $this->BarChart();

            $newExpertisesByMonth = $this->BarChart('expertises');


            return Inertia::render('Dashboard/Leaders', ['stats' => ['users' => $totalUsers, 'projects' => $totalProjects, 'posts' => $totalPosts, 'dates' => $totalDates], 'usersByMonth' => $newUsersByMonth, 'expertises' => $newExpertisesByMonth, 'likes' => $newLikesByMonth]);
        } else {
            $user = $request->user();

            $totalPosts = Post::where('user_id', $user->id)->count();
            $totalComments = Comment::where('user_id', $user->id)->count();

            return Inertia::render('Dashboard/Users', ['stats' => ['comments' => $totalComments, 'posts' => $totalPosts], 'likes' => $newLikesByMonth]);
        }
    }
}
