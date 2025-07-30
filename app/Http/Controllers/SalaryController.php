<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\Salary;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('salary', compact('employees'));
    }

    public function calculate(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $month = Carbon::parse($request->month);
        $bonus = $request->bonus ?? 0;

        $leaves = Attendance::where('employee_id', $employee->id)
            ->whereMonth('date', $month->month)
            ->whereYear('date', $month->year)
            ->where('status', 'absent')
            ->count();

        $per_day_salary = $employee->salary / 30;
        $leave_deduction = $leaves * $per_day_salary;
        $net_salary = $employee->salary - $leave_deduction + $bonus;

        $salary = [
            'employee_id'     => $employee->id,
            'employee_name'   => $employee->name,
            'base_salary'     => $employee->salary,
            'month'           => $request->month,
            'leaves'          => $leaves,
            'leave_deduction' => $leave_deduction,
            'bonus'           => $bonus,
            'net_salary'      => $net_salary,
        ];

        // ✅ Notification for salary calculation
        Notification::create([
            'type'    => 'salary',
            'message' => 'Salary calculated for ' . $employee->name . ' for ' . $month->format('F Y'),
        ]);

        return view('salary', [
            'employees' => Employee::all(),
            'salary' => $salary,
            'allSalaries' => Salary::all()

        ]);
    }

    public function generatePayslip($id, $month)
    {
        $employee = Employee::findOrFail($id);
        $monthObj = Carbon::parse($month);

        $leaves = Attendance::where('employee_id', $id)
            ->whereMonth('date', $monthObj->month)
            ->whereYear('date', $monthObj->year)
            ->where('status', 'absent')
            ->count();

        $per_day_salary = $employee->salary / 30;
        $leave_deduction = $leaves * $per_day_salary;
        $net_salary = $employee->salary - $leave_deduction;

        $data = [
            'employee'        => $employee,
            'month'           => $month,
            'leaves'          => $leaves,
            'leave_deduction' => $leave_deduction,
            'net_salary'      => $net_salary,
            'bonus'           => 0, // You can extend to include bonus
        ];

        $pdf = Pdf::loadView('payslip_pdf', $data);
        return $pdf->download("Payslip_{$employee->name}_{$month}.pdf");
    }

    public function show($id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('live-search.salary-show', compact('salary'));
    }

}   