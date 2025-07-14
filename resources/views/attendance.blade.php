@extends('layout')

@section('content')

<!-- Title -->
<h2 class="text-2xl font-bold mb-6">Attendance Management</h2>

<!-- 🔹 Attendance Entry Form -->
<div class="bg-white p-6 rounded-lg shadow-md mb-10">
    <h3 class="text-lg font-semibold mb-4">Mark Attendance</h3>
    <form method="POST" action="{{ route('attendance.store') }}" class="grid md:grid-cols-3 gap-6">
        @csrf
        <div>
            <label class="block text-sm font-medium">Employee</label>
            <select name="employee_id" class="w-full border rounded px-4 py-2">
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Date</label>
            <input type="date" name="date" class="w-full border rounded px-4 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="w-full border rounded px-4 py-2">
                <option value="present">Present</option>
                <option value="absent">Absent</option>
                <option value="late">Late</option>
                <option value="leave">Leave</option>
            </select>
        </div>
        <div class="md:col-span-3 text-right">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Mark Attendance</button>
        </div>
    </form>
</div>

<!-- 🔹 Attendance Records Table -->
<div class="bg-white p-6 rounded-lg shadow-md mb-10">
    <h3 class="text-lg font-semibold mb-4">Attendance Records</h3>

    <!-- Filter -->
    <form method="GET" action="{{ route('attendance.index') }}" class="flex flex-wrap items-center gap-4 mb-4">
        <select name="employee_id" class="border px-3 py-2 rounded">
            <option value="">All Employees</option>
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
            @endforeach
        </select>
        <input type="month" name="month" class="border px-3 py-2 rounded">
        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">Filter</button>
    </form>

    <table class="w-full table-auto text-sm border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">#</th>
                <th class="border px-3 py-2">Employee</th>
                <th class="border px-3 py-2">Date</th>
                <th class="border px-3 py-2">Status</th>
                <th class="border px-3 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $i => $att)
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">{{ $i + 1 }}</td>
                    <td class="border px-3 py-2">{{ $att->employee->name }}</td>
                    <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($att->date)->format('d M Y') }}</td>
                    <td class="border px-3 py-2 capitalize">{{ $att->status }}</td>
                    <td class="border px-3 py-2 space-x-2">
                        <a href="{{ route('attendance.edit', $att->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('attendance.destroy', $att->id) }}" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this record?')" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if($attendances->isEmpty())
                <tr><td colspan="5" class="text-center py-4 text-gray-500">No records found.</td></tr>
            @endif
        </tbody>
    </table>
</div>

<!-- 🔹 Attendance Report Section -->
<section class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">📊 Attendance Report</h2> <br>
            <p class="text-sm text-gray-500">Generate attendance reports by employee and date range. Export as PDF.</p> <br>
        </div>
    </div>

    <form method="GET" action="{{ route('attendance.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
        <!-- Employee Selection -->
        <div>
            <label for="employee_id" class="block text-sm font-medium text-gray-700">Select Employee</label> <br>
            <select name="employee_id" id="employee_id" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">All Employees</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Report Type -->
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Report Type</label> <br>
            <select name="type" id="type" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="daily" {{ request('type') == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ request('type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ request('type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </div>

        <!-- Date -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label> <br>
            <input type="date" name="date" id="date" value="{{ request('date') }}"
                   class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <!-- Get Report Button -->
        <div>
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                🔍 Get Report
            </button>
        </div>

        <!-- Download PDF -->
        @if(request('type') && request('date'))
        <div>
            <a href="{{ route('attendance.pdf', [
                        'employee_id' => request('employee_id'),
                        'type' => request('type'),
                        'date' => request('date')
                    ]) }}"
               class="w-full inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 text-center rounded-lg transition duration-200">
                ⬇️ Download PDF
            </a>
        </div>
        @endif
    </form>
</section>

@endsection
