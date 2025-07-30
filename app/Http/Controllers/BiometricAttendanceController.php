<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiometricAttendance;
use App\Models\Employee;

class BiometricAttendanceController extends Controller
{
    public function index()
    {
        $attendances = BiometricAttendance::with('employee')->latest()->get();
        return view('biometric.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('biometric.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'time_in' => 'nullable',
            'time_out' => 'nullable',
        ]);

        BiometricAttendance::create($request->all());

        return redirect()->route('biometric.index')->with('success', 'Biometric attendance recorded.');
    }
}
