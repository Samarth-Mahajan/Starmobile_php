<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with user stats.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Get total users count
        $totalUsers = User::count();
        
        // Get users registered today
        $newUsersToday = User::whereDate('created_at', today())->count();
        
        // Get users registered in the last 7 days
        $lastWeekUsers = User::whereDate('created_at', '>=', now()->subDays(7))->count();
        
        // Get users registered in the last 30 days
        $lastMonthUsers = User::whereDate('created_at', '>=', now()->subDays(30))->count();
        
        // Calculate month-over-month growth
        $previousMonthUsers = User::whereDate('created_at', '<', now()->subDays(30))
            ->whereDate('created_at', '>=', now()->subDays(60))
            ->count();
        
        $growthRate = $previousMonthUsers > 0 
            ? round((($lastMonthUsers - $previousMonthUsers) / $previousMonthUsers) * 100, 1) 
            : 0;
        
        // User registration trend (last 7 days)
        $registrationTrend = User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'count' => $item->count
                ];
            });
        
        return Inertia::render('Dashboard', [
            'stats' => [
                'totalUsers' => $totalUsers,
                'newUsersToday' => $newUsersToday,
                'lastWeekUsers' => $lastWeekUsers,
                'lastMonthUsers' => $lastMonthUsers,
                'growthRate' => $growthRate,
                'registrationTrend' => $registrationTrend,
            ],
        ]);
    }
}