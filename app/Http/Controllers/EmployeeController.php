<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Notification;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee-form', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cnic' => 'required',
            'designation' => 'required',
            'joining_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        $employee = Employee::create($request->all());

        // ✅ Add notification
        Notification::create([
            'type' => 'employee',
            'message' => 'New employee added: ' . $employee->name,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $employees = Employee::all(); // For listing again in the same view

        return view('employee-form', compact('employee', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'cnic' => 'required',
            'designation' => 'required',
            'joining_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        $emp = Employee::findOrFail($id);
        $emp->update($request->all());

        // ✅ Add notification
        Notification::create([
            'type' => 'employee',
            'message' => 'Employee updated: ' . $emp->name,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $emp = Employee::findOrFail($id);
        $emp->delete();

        // ✅ Add notification
        Notification::create([
            'type' => 'employee',
            'message' => 'Employee deleted: ' . $emp->name,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
    

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('live-search.employee-show', compact('employee'));
    }

}
