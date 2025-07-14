<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Notification;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();

        $historyQuery = Leave::with('employee');

        if ($request->employee_id) {
            $historyQuery->where('employee_id', $request->employee_id);
        }

        if ($request->month) {
            $historyQuery->whereMonth('from_date', date('m', strtotime($request->month)));
        }

        $leaveHistory  = $historyQuery->latest()->get();
        $pendingLeaves = Leave::where('status', 'pending')->with('employee')->get();

        return view('leaves', compact('employees', 'leaveHistory', 'pendingLeaves'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type'  => 'required',
            'from_date'   => 'required|date',
            'to_date'     => 'required|date|after_or_equal:from_date',
            'reason'      => 'required|string',
        ]);

        $leave = Leave::create([
            'employee_id' => $request->employee_id,
            'leave_type'  => $request->leave_type,
            'from_date'   => $request->from_date,
            'to_date'     => $request->to_date,
            'reason'      => $request->reason,
            'status'      => 'pending',
        ]);

        // ✅ Notification: new leave request
        Notification::create([
            'type'    => 'leave',
            'message' => 'New leave request from ' . $leave->employee->name,
        ]);

        return back()->with('success', 'Leave request submitted.');
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);

        // ✅ Notification: leave approved
        Notification::create([
            'type'    => 'leave',
            'message' => 'Leave approved for ' . $leave->employee->name,
        ]);

        return back()->with('success', 'Leave approved.');
    }

    public function reject($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'rejected']);

        // ✅ Notification: leave rejected
        Notification::create([
            'type'    => 'leave',
            'message' => 'Leave rejected for ' . $leave->employee->name,
        ]);

        return back()->with('success', 'Leave rejected.');
    }

  
     public function show($id)
    {
        $leave = Leave::with('employee')->findOrFail($id);
        return view('live-search.leave-show', compact('leave'));
    }

}
