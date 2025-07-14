<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Salary;
use App\Models\Report;

class LiveSearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $query = $request->get('query');
            $results = [];

            // 🔹 Employees
            $employees = Employee::where('name', 'like', "%{$query}%")
                ->orWhere('cnic', 'like', "%{$query}%")
                ->orWhere('designation', 'like', "%{$query}%")
                ->limit(5)->get();
            foreach ($employees as $emp) {
                $results[] = [
                    'type' => 'Employee',
                    'label' => $emp->name . " ({$emp->designation})",
                    'url' => url('/employees/' . $emp->id),
                ];
            }

            // 🔹 Attendance
            $attendances = Attendance::where('status', 'like', "%{$query}%")
                ->orWhere('date', 'like', "%{$query}%")
                ->limit(5)->get();
            foreach ($attendances as $att) {
                $results[] = [
                    'type' => 'Attendance',
                    'label' => $att->date . ' – ' . ucfirst($att->status),
                    'url' => url('/attendance/' . $att->id),
                ];
            }

            // 🔹 Leaves
            $leaves = Leave::where('leave_type', 'like', "%{$query}%")
                ->orWhere('reason', 'like', "%{$query}%")
                ->limit(5)->get();
            foreach ($leaves as $leave) {
                $results[] = [
                    'type' => 'Leave',
                    'label' => $leave->leave_type . ' – ' . $leave->reason,
                    'url' => url('/leaves/' . $leave->id),
                ];
            }

            // 🔹 Salaries
            $salaries = Salary::where('salary_date', 'like', "%{$query}%")
                ->orWhere('net_salary', 'like', "%{$query}%")
                ->limit(5)->get();
            foreach ($salaries as $sal) {
                $results[] = [
                    'type' => 'Salary',
                    'label' => $sal->salary_date . ' – Rs. ' . $sal->net_salary,
                    'url' => url('/salary/payslip/' . $sal->id . '/' . $sal->salary_date),
                ];
            }

           // 🔹 Reports
$reports = Report::where('title', 'like', "%{$query}%")
    ->orWhere('type', 'like', "%{$query}%")
    ->limit(5)->get();

foreach ($reports as $rep) {
    $results[] = [
        'type' => 'Report',
        'label' => $rep->title . ' – ' . $rep->type,
        'url' => url('/reports' . $rep->id),
    ];
}

            // 🔹 Static Routes
            if (stripos('home dashboard overview', $query) !== false) {
                $results[] = [
                    'type' => 'Home',
                    'label' => 'Go to Dashboard',
                    'url' => url('/dashboard'),
                ];
            }

            if (stripos('setting change password system', $query) !== false) {
                $results[] = [
                    'type' => 'Settings',
                    'label' => 'Open System Settings',
                    'url' => url('/settings'),
                ];
            }

            return response()->json($results);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
