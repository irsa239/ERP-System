@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow p-6 rounded">

    {{-- Employee --}}
    @isset($employee)
        <h2 class="text-2xl font-bold mb-4">Employee Details</h2>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <p><strong>CNIC:</strong> {{ $employee->cnic }}</p>
        <p><strong>Designation:</strong> {{ $employee->designation }}</p>
        <p><strong>Joining Date:</strong> {{ $employee->joining_date }}</p>
        <p><strong>Salary:</strong> Rs. {{ $employee->salary }}</p>
    @endisset

    {{-- Attendance --}}
    @isset($attendance)
        <h2 class="text-2xl font-bold mb-4">Attendance Record</h2>
        <p><strong>Employee:</strong> {{ $attendance->employee->name ?? 'N/A' }}</p>
        <p><strong>Date:</strong> {{ $attendance->date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($attendance->status) }}</p>
    @endisset

    {{-- Leave --}}
    @isset($leave)
        <h2 class="text-2xl font-bold mb-4">Leave Application</h2>
        <p><strong>Employee:</strong> {{ $leave->employee->name ?? 'N/A' }}</p>
        <p><strong>Leave Type:</strong> {{ $leave->leave_type }}</p>
        <p><strong>From:</strong> {{ $leave->from_date }}</p>
        <p><strong>To:</strong> {{ $leave->to_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($leave->status) }}</p>
        <p><strong>Reason:</strong> {{ $leave->reason }}</p>
    @endisset

    {{-- Salary --}}
    @isset($salary)
        <h2 class="text-2xl font-bold mb-4">Salary Detail</h2>
        <p><strong>Employee:</strong> {{ $salary->employee->name ?? 'N/A' }}</p>
        <p><strong>Salary Date:</strong> {{ $salary->salary_date }}</p>
        <p><strong>Basic Salary:</strong> Rs. {{ $salary->basic_salary }}</p>
        <p><strong>Allowance:</strong> Rs. {{ $salary->allowance }}</p>
        <p><strong>Deductions:</strong> Rs. {{ $salary->deductions }}</p>
        <p><strong>Net Salary:</strong> Rs. {{ $salary->net_salary }}</p>
    @endisset

    {{-- Report --}}
    @isset($report)
        <h2 class="text-2xl font-bold mb-4">Report Detail</h2>
        <p><strong>Title:</strong> {{ $report->title }}</p>
        <p><strong>Type:</strong> {{ $report->type }}</p>
        <p><strong>Summary:</strong> {{ $report->summary ?? 'N/A' }}</p>
    @endisset

</div>
@endsection
