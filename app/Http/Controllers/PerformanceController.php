<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Feedback;
use App\Models\PerformanceScore;
use App\Models\Warning;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PerformanceController extends Controller
{
   
public function index()
{
    $month = now()->format('F Y');

    $performances = Employee::with(['attendances', 'tasks', 'leaves', 'feedbacks', 'warnings', 'performanceScores'])->get()->map(function ($employee) use ($month) {

        // Agar us month ka performance score mojood ho toh woh use karo
        $currentMonthScore = $employee->performanceScores
            ->where('month', $month)
            ->last();

        $score = $currentMonthScore ? $currentMonthScore->score : $this->calculatePerformanceScore($employee);
        $rating = $this->rateScore($score);

        return (object)[
            'employee' => $employee,
            'score' => $score,
            'rating' => $rating,
            'month' => $month,
            'id' => $employee->id,
            'feedback' => $currentMonthScore?->remarks ?? optional($employee->feedbacks->last())->comment ?? 'No feedback'

        ];
    });

    return view('performance.index', compact('performances', 'month'));
}


    public function create()
    {
        $employees = Employee::all();
        return view('performance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'score' => 'required|numeric|min:0|max:100',
            'feedback' => 'required|string|max:1000',
        ]);

        PerformanceScore::create([
            'employee_id' => $request->employee_id,
            'score' => $request->score,
            'feedback' => $request->feedback,
            'month' => now()->format('F Y'),
        ]);

        return redirect()->route('performance.index')->with('success', 'Performance record added successfully.');
    }

    public function show($id)
    {
        $employee = Employee::with(['attendances', 'tasks', 'leaves', 'feedbacks', 'warnings'])->findOrFail($id);
        $total = $this->calculatePerformanceScore($employee);
        $rating = $this->rateScore($total);

        $months = collect(range(0, 11))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('F Y');
        });

        $scores = PerformanceScore::where('employee_id', $id)->orderBy('created_at', 'desc')->limit(12)->pluck('score');

        return view('performance.show', compact('employee', 'total', 'rating', 'months', 'scores'));
    }


public function storeSelfEvaluation(Request $request)
{
    // Validation (optional but recommended)
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'month' => 'required',
        'self_rating' => 'required|numeric|min:1|max:5',
        'challenges' => 'nullable|string',
        'goals' => 'nullable|string',
    ]);

    // Remarks banayein
    $remarks = 'Challenges: ' . $request->challenges . ' | Goals: ' . $request->goals;

    // Data save karo
    PerformanceScore::create([
        'employee_id' => $request->employee_id,
        'month' => $request->month,
        'score' => $request->self_rating * 10, // logic tumhara ho sakta hai
        'remarks' => $remarks,
    ]);

    return redirect()->back()->with('success', 'Self evaluation submitted successfully!');
}

    

    public function download($id)
    {
        $employee = Employee::with([
            'attendances',
            'tasks',
            'leaves',
            'feedbacks',
            'warnings',
            'performanceScores',
            'selfEvaluations',
        ])->findOrFail($id);

        $performances = $employee->performanceScores;

        $pdf = PDF::loadView('performance.pdf', [
            'employee' => $employee,
            'performances' => $performances,
        ]);

        return $pdf->download($employee->name . '_Performance_Report.pdf');
    }

    public function downloadPdf($id)
    {
        $employee = Employee::with(['attendances', 'tasks', 'leaves', 'feedbacks', 'warnings'])->findOrFail($id);
        $total = $this->calculatePerformanceScore($employee);
        $rating = $this->rateScore($total);

        $pdf = Pdf::loadView('performance.pdf', compact('employee', 'total', 'rating'));
        return $pdf->download('performance_report_' . $employee->id . '.pdf');
    }

    private function calculatePerformanceScore($employee)
    {
        $score = 0;

        $score += $employee->attendances->where('status', 'Present')->count();
        $score += $employee->tasks->where('status', 'Completed')->count() * 2;
        $score += $employee->feedbacks->where('type', 'Positive')->count() * 3;
        $score -= $employee->warnings->count() * 2;
        $extraLeaves = max(0, $employee->leaves->count() - 2);
        $score -= $extraLeaves;

        return $score;
    }

    private function rateScore($score)
    {
        if ($score >= 90) return 'Excellent';
        if ($score >= 70) return 'Good';
        if ($score >= 50) return 'Average';
        return 'Poor';
    }
}
