<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Attendance;
use App\Models\Salary;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total number of employees
        $employeeCount = Employee::count();

        // Total leaves requested in the current month
      $leavesThisMonth = Leave::whereMonth('from_date', now()->month)->count();

        // Total present employees today
        $presentToday = Attendance::whereDate('date', Carbon::today())
                            ->where('status', 'present')
                            ->count();

        // Total salary paid or generated
        $salaryTotal = Salary::sum('net_salary');

        // 5 most recent leave requests with employee names
        $recentLeaves = Leave::latest()
                        ->take(5)
                        ->with('employee')
                        ->get();

        // Pass data to the dashboard view
        return view('dashboard', [
            'employeeCount' => $employeeCount,
            'leavesThisMonth' => $leavesThisMonth,
            'presentToday' => $presentToday,
            'salaryTotal' => $salaryTotal,
            'recentLeaves' => $recentLeaves,
        ]);
    }
}
