@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Employee Details</h2>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <h3 class="font-semibold">Name:</h3>
            <p>{{ $employee->name }}</p>
        </div>
        <div>
            <h3 class="font-semibold">CNIC:</h3>
            <p>{{ $employee->cnic }}</p>
        </div>
        <div>
            <h3 class="font-semibold">Designation:</h3>
            <p>{{ $employee->designation }}</p>
        </div>
        <div>
            <h3 class="font-semibold">Joining Date:</h3>
            <p>{{ \Carbon\Carbon::parse($employee->joining_date)->format('d M, Y') }}</p>
        </div>
        <div>
            <h3 class="font-semibold">Salary:</h3>
            <p>Rs. {{ number_format($employee->salary, 2) }}</p>
        </div>
    </div>

    <a href="{{ route('employees.index') }}" class="inline-block mt-6 px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back to Employees</a>
</div>
@endsection
