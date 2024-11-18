<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Schedule;
use App\Models\JobVacancy;
use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $startOfWeek = Carbon::now()->startOfWeek(); // Awal minggu (Senin)
        $endOfWeek = Carbon::now()->endOfWeek();     // Akhir minggu (Minggu)
        $startOfMonth = Carbon::now()->startOfMonth(); // Awal bulan
        $endOfMonth = Carbon::now()->endOfMonth();     // Akhir bulan

        $userCount = User::role(['admin', 'superadmin'])->count();
        $jobCount = JobVacancy::where('status','Active')->count();
        $interviewCount = Schedule::where('status','Upcoming')->count();
        $applicantCount = Application::where('status','Pending')->count();
        $todayAplCount = Application::whereDate('created_at', Carbon::today())
            ->count();
        $thisWeekAplCount = Application::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
        $thisMonthAplCount = Application::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();
        $applicationsPerMonth = [];

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            $applicationsPerMonth[] = Application::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $month)
                ->count();
        }
        return view('dashboard',[
            'userCount' => $userCount,
            'jobCount' => $jobCount,
            'interviewCount' => $interviewCount,
            'applicantCount' => $applicantCount,
            'todayAplCount' => $todayAplCount,
            'thisWeekAplCount' => $thisWeekAplCount,
            'thisMonthAplCount' => $thisMonthAplCount,
            'applicationsPerMonth' => $applicationsPerMonth,
        ]);
    }
}
