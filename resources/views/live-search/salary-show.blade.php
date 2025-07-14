@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700">Salary Details</h2>

    <p><strong>Employee:</strong> {{ $salary->employee->name }}</p>
    <p><strong>Basic Salary:</strong> Rs. {{ number_format($salary->basic_salary, 2) }}</p>
    <p><strong>Allowance:</strong> Rs. {{ number_format($salary->allowance ?? 0, 2) }}</p>
    <p><strong>Deductions:</strong> Rs. {{ number_format($salary->deductions ?? 0, 2) }}</p>
    <p><strong>Net Salary:</strong> Rs. {{ number_format($salary->net_salary, 2) }}</p>
    <p><strong>Salary Date:</strong> {{ \Carbon\Carbon::parse($salary->salary_date)->format('d M, Y') }}</p>

    <a href="{{ route('salary.index') }}" class="inline-block mt-6 px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Back to Salary List</a>
</div>
@endsection
