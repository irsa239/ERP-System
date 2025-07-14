<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Notification; // ✅ Add this line
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\SimpleExcel\SimpleExcelWriter;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();

        $query = Attendance::with('employee');

        if ($request->employee_id) {
            $query->where('employee_id', $request->employee_id);
        }

        $type = $request->type ?? 'daily';
        $date = $request->date ?? Carbon::today()->toDateString();

        if ($type === 'daily') {
            $query->whereDate('date', $date);
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($date)->startOfWeek();
            $end = Carbon::parse($date)->endOfWeek();
            $query->whereBetween('date', [$start, $end]);
        } elseif ($type === 'monthly') {
            $query->whereMonth('date', Carbon::parse($date)->month)
                  ->whereYear('date', Carbon::parse($date)->year);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        $summary = null;
        if ($request->employee_id && $type === 'monthly') {
            $month = Carbon::parse($date)->month;
            $year = Carbon::parse($date)->year;

            $summary = [
                'present' => Attendance::where('employee_id', $request->employee_id)
                    ->whereMonth('date', $month)->whereYear('date', $year)
                    ->where('status', 'present')->count(),
                'absent' => Attendance::where('employee_id', $request->employee_id)
                    ->whereMonth('date', $month)->whereYear('date', $year)
                    ->where('status', 'absent')->count(),
                'late' => Attendance::where('employee_id', $request->employee_id)
                    ->whereMonth('date', $month)->whereYear('date', $year)
                    ->where('status', 'late')->count(),
                'leave' => Attendance::where('employee_id', $request->employee_id)
                    ->whereMonth('date', $month)->whereYear('date', $year)
                    ->where('status', 'leave')->count(),
            ];
        }

        return view('attendance', compact('employees', 'attendances', 'summary'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late,leave',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        Attendance::updateOrCreate(
            ['employee_id' => $request->employee_id, 'date' => $request->date],
            ['status' => $request->status]
        );

        // ✅ Create a notification
        Notification::create([
            'type' => 'attendance',
            'message' => 'Attendance marked as ' . $request->status . ' for ' . $employee->name . ' on ' . $request->date,
        ]);

        return back()->with('success', 'Attendance marked successfully.');
    }

    public function destroy($id)
    {
        Attendance::destroy($id);
        return back()->with('success', 'Attendance record deleted.');
    }

    public function export()
    {
        $attendances = Attendance::with('employee')->get();

        $filePath = storage_path('app/attendance-export.csv');

        SimpleExcelWriter::create($filePath)
            ->addRows($attendances->map(function ($attendance) {
                return [
                    'Employee Name' => $attendance->employee->name ?? 'N/A',
                    'Date' => $attendance->date,
                    'Status' => ucfirst($attendance->status),
                ];
            })->toArray());

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportPdf(Request $request)
    {
        $query = Attendance::with('employee');

        if ($request->employee_id) {
            $query->where('employee_id', $request->employee_id);
        }

        $type = $request->type ?? 'daily';
        $date = $request->date ?? Carbon::today()->toDateString();

        if ($type === 'daily') {
            $query->whereDate('date', $date);
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($date)->startOfWeek();
            $end = Carbon::parse($date)->endOfWeek();
            $query->whereBetween('date', [$start, $end]);
        } elseif ($type === 'monthly') {
            $query->whereMonth('date', Carbon::parse($date)->month)
                  ->whereYear('date', Carbon::parse($date)->year);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        $pdf = Pdf::loadView('attendance_pdf', [
            'attendances' => $attendances,
            'type' => $type,
            'date' => $date,
        ]);

        return $pdf->download('attendance-report.pdf');
    }


    
    public function show($id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        return view('live-search.attendance-show', compact('attendance'));
    }

}
