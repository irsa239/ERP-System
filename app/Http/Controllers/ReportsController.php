<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Salary;
use Carbon\Carbon;
use App\Models\Report;


class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();
        $type = $request->type ?? 'attendance'; // Default report type
        $records = [];

        if ($request->employee_id && $request->month) {
            $month = Carbon::parse($request->month)->month;
            $year = Carbon::parse($request->month)->year;

            if ($type === 'attendance') {
                $records = Attendance::with('employee')
                    ->where('employee_id', $request->employee_id)
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->get();

            } elseif ($type === 'leave') {
                $records = Leave::with('employee')
                    ->where('employee_id', $request->employee_id)
                    ->whereMonth('from_date', $month)
                    ->whereYear('from_date', $year)
                    ->get();

            } elseif ($type === 'salary') {
                $records = Salary::with('employee')
                    ->where('employee_id', $request->employee_id)
                    ->whereMonth('salary_date', $month)
                    ->whereYear('salary_date', $year)
                    ->get();
            }
        }

        return view('reports', compact('employees', 'records', 'type'));
    }
     public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('live-search.report-show', compact('report'));
    }

}
