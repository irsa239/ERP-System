@extends('layouts.pdf')

@section('title', 'Payslip - ' . $employee->name)

@section('content')

    <!-- Company Header -->
    <h1 style="text-align:center; margin-bottom:0;">SmartStaff HR ERP System</h1>
    <p style="text-align:center; margin-top:2px;">Salary Payslip for the Month of {{ \Carbon\Carbon::parse($month)->format('F Y') }}</p>
    <hr>

    <!-- Employee Info -->
    <h3>Employee Details</h3>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $employee->name }}</td>
            <th>Designation</th>
            <td>{{ $employee->designation ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Employee ID</th>
            <td>{{ $employee->id }}</td>
            <th>Joining Date</th>
            <td>{{ \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>CNIC</th>
            <td>{{ $employee->cnic ?? 'N/A' }}</td>
            <th>Salary Month</th>
            <td>{{ \Carbon\Carbon::parse($month)->format('F Y') }}</td>
        </tr>
    </table>

    <!-- Salary Breakdown -->
    <h3 style="margin-top: 30px;">Salary Breakdown</h3>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Base Salary</td>
                <td>{{ number_format($employee->salary, 2) }}</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td>{{ number_format($bonus, 2) }}</td>
            </tr>
            <tr>
                <td>Leave Deduction ({{ $leaves }} days)</td>
                <td>-{{ number_format($leave_deduction, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Net Salary</th>
                <th>Rs. {{ number_format($net_salary, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <!-- Footer -->
    <div style="margin-top: 40px;">
        <p><strong>Note:</strong> This is a system-generated payslip and does not require signature.</p>
    </div>

@endsection
