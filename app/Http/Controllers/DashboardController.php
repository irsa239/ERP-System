<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Attendance;
use App\Models\Salary;
use App\Models\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $employeeCount = Employee::count();

        $leavesThisMonth = Leave::whereMonth('from_date', now()->month)->count();

        $presentToday = Attendance::whereDate('date', Carbon::today())
                            ->where('status', 'present')
                            ->count();

        $salaryTotal = Salary::sum('net_salary');

        $recentLeaves = Leave::latest()
                        ->take(5)
                        ->with('employee')
                        ->get();

        $today = Carbon::today();
        $thirtyDaysLater = $today->copy()->addDays(30);

        // 🎉 Work Anniversaries
        $anniversaries = Employee::get()->map(function ($employee) use ($today, $thirtyDaysLater) {
            $joiningDate = Carbon::parse($employee->joining_date);
            $thisYearAnniversary = $joiningDate->copy()->year($today->year);

            if ($thisYearAnniversary->lt($today)) {
                $thisYearAnniversary->addYear();
            }

            $years = $today->year - $joiningDate->year;

            return (object)[
                'title' => $employee->name . "'s Work Anniversary",
                'type' => 'Work Anniversary',
                'date' => $thisYearAnniversary,
                'years' => $years,
            ];
        })->filter(function ($event) use ($today, $thirtyDaysLater) {
            return $event->date->between($today, $thirtyDaysLater);
        });

        // 🎯 Custom Events
        $customEvents = Event::whereBetween('event_date', [$today, $thirtyDaysLater])
            ->get()
            ->map(function ($event) {
                return (object)[
                    'title' => $event->title,
                    'type' => $event->type,
                    'date' => Carbon::parse($event->event_date),
                ];
            });

        // 🧠 Merge both
        $upcomingEvents = collect($anniversaries)
            ->merge($customEvents)
            ->sortBy('date')
            ->values();

        // 🎖 Top Performers
        $topPerformers = Employee::take(3)->get();

        return view('dashboard', [
            'employeeCount' => $employeeCount,
            'leavesThisMonth' => $leavesThisMonth,
            'presentToday' => $presentToday,
            'salaryTotal' => $salaryTotal,
            'recentLeaves' => $recentLeaves,
            'upcomingEvents' => $upcomingEvents,
            'topPerformers' => $topPerformers,
        ]);
    }
}
