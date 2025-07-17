<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Models\Inquiry;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $myTeams = Team::with(['images', 'prefecture'])
        ->where('user_id', Auth::id())
        ->get();

        $latestInquiries = Inquiry::whereIn('team_id', $myTeams->pluck('id'))
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('myTeams', 'latestInquiries'));
    }
}