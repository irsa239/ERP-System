@extends('layout')

@section('title', 'ERP Reports')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">ERP Reports Dashboard</h1>

    {{-- Filters --}}
    <form method="GET" action="{{ route('reports.index') }}" class="mb-6 bg-white p-4 rounded shadow">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Employee</label>
                <select name="employee_id" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">All</option>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                            {{ $emp->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Month</label>
                <input type="month" name="month" value="{{ request('month') }}" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Report Type</label>
                <select name="type" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                    <option value="attendance" {{ request('type') == 'attendance' ? 'selected' : '' }}>Attendance</option>
                    <option value="leave" {{ request('type') == 'leave' ? 'selected' : '' }}>Leave</option>
                    <option value="salary" {{ request('type') == 'salary' ? 'selected' : '' }}>Salary</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button 
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    Generatre Report
  </button>
    </div>
    </form>

    {{-- Report Table --}}
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            @if ($type == 'attendance')
                Attendance Report
            @elseif ($type == 'leave')
                Leave Report
            @else
                Salary Report
            @endif
        </h2>

        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Employee</th>
                    <th class="border px-4 py-2">Date</th>
                    @if ($type == 'attendance')
                        <th class="border px-4 py-2">Status</th>
                    @elseif ($type == 'leave')
                        <th class="border px-4 py-2">Leave Type</th>
                        <th class="border px-4 py-2">Status</th>
                    @else
                        <th class="border px-4 py-2">Net Salary</th>
                        <th class="border px-4 py-2">Month</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $index => $record)
                    <tr class="text-sm">
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $record->employee->name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">
                            @if ($type == 'salary')
                                {{ \Carbon\Carbon::parse($record->month)->format('F Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}
                            @endif
                        </td>
                        @if ($type == 'attendance')
                            <td class="border px-4 py-2 capitalize">{{ $record->status }}</td>
                        @elseif ($type == 'leave')
                            <td class="border px-4 py-2">{{ $record->leave_type }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($record->status) }}</td>
                        @else
                            <td class="border px-4 py-2">Rs. {{ number_format($record->net_salary, 0) }}</td>
                            <td class="border px-4 py-2">{{ $record->month }}</td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No records found for selected filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
