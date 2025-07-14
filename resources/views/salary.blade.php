@extends('layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">Salary Generation</h2>

<!-- Salary Generation Form -->
<div class="bg-white p-6 rounded-lg shadow-md mb-10">
    <h3 class="text-lg font-semibold mb-4">Generate Salary for an Employee</h3>

    <form method="POST" action="{{ route('salary.calculate') }}" class="grid md:grid-cols-3 gap-6">
        @csrf
        <div>
            <label class="block text-sm font-medium">Select Employee</label>
            <select name="employee_id" class="w-full border px-4 py-2 rounded" required>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Month</label>
            <input type="month" name="month" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Bonus (PKR)</label>
            <input type="number" name="bonus" value="0" class="w-full border px-4 py-2 rounded">
        </div>

        <div class="md:col-span-3 text-right">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Calculate Salary</button>
        </div>
    </form>
</div>

<!-- Show Calculated Salary -->
@if(isset($salary))
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold mb-4">Salary Details</h3>
    
    <div class="grid md:grid-cols-2 gap-6 text-sm">
        <div>
            <p><strong>Employee:</strong> {{ $salary['employee_name'] }}</p>
            <p><strong>Month:</strong> {{ $salary['month'] }}</p>
            <p><strong>Base Salary:</strong> Rs. {{ number_format($salary['base_salary']) }}</p>
        </div>
        <div>
            <p><strong>Total Leaves:</strong> {{ $salary['leaves'] }}</p>
            <p><strong>Leave Deduction:</strong> Rs. {{ number_format($salary['leave_deduction']) }}</p>
            <p><strong>Bonus:</strong> Rs. {{ number_format($salary['bonus']) }}</p>
        </div>
    </div>

    <hr class="my-4">

    <h4 class="text-xl font-semibold">Net Pay: Rs. {{ number_format($salary['net_salary']) }}</h4>

    <div class="mt-6 text-right">
        <a href="{{ route('salary.payslip', ['id' => $salary['employee_id'], 'month' => $salary['month']]) }}" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
            Generate Payslip (PDF)
        </a>
    </div>
</div>
@endif

@endsection
