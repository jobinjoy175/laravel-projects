<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class StatisticsController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalUsers = User::count();
        $averageEventsPerUser = $totalUsers ? $totalEvents / $totalUsers : 0;

        $users = User::withCount('events')
                     ->get()
                     ->map(function ($user) {
                         return [
                             'name' => $user->name,
                             'average' => $user->events_count
                         ];
                     });

        return view('statistics.index', compact('averageEventsPerUser', 'users'));
    }
}
