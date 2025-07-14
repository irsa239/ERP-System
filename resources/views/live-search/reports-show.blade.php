@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Generate Reports</h2>

    {{-- Filter Form --}}
    <form action="{{ route('reports.index') }}" method="GET" class="mb-8 flex flex-wrap gap-4 items-end">
        <div>
            <label for="employee_id" class="block font-semibold mb-1">Select Employee</label>
            <select name="employee_id" id="employee_id" class="border rounded p-2 w-64">
                <option value="">-- All Employees --</option>
                @foreach ($employees as $emp)
                    <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                        {{ $emp->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="month" class="block font-semibold mb-1">Select Month</label>
            <input type="month" name="month" id="month" value="{{ request('month') }}" class="border rounded p-2">
        </div>

        <div>
            <label for="type" class="block font-semibold mb-1">Report Type</label>
            <select name="type" id="type" class="border rounded p-2 w-48">
                <option value="attendance" {{ request('type') == 'attendance' ? 'selected' : '' }}>Attendance</option>
                <option value="leave" {{ request('type') == 'leave' ? 'selected' : '' }}>Leave</option>
                <option value="salary" {{ request('type') == 'salary' ? 'selected' : '' }}>Salary</option>
            </select>
        </div>

        <div>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Generate</button>
        </div>
    </form>

    {{-- Report Results --}}
    @if($records->isEmpty())
        <p class="text-gray-600 mt-10">No records found for the selected filters.</p>
    @else
        <h3 class="text-xl font-semibold mb-4 text-gray-700 capitalize">{{ $type }} Report</h3>

        @if($type == 'attendance')
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Date</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $att)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($att->date)->format('d M, Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $att->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif($type == 'leave')
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Leave Type</th>
                        <th class="border border-gray-300 px-4 py-2">From Date</th>
                        <th class="border border-gray-300 px-4 py-2">To Date</th>
                        <th class="border border-gray-300 px-4 py-2">Reason</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $leave)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $leave->leave_type }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($leave->from_date)->format('d M, Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($leave->to_date)->format('d M, Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $leave->reason }}</td>
                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $leave->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif($type == 'salary')
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Salary Date</th>
                        <th class="border border-gray-300 px-4 py-2">Basic Salary</th>
                        <th class="border border-gray-300 px-4 py-2">Allowance</th>
                        <th class="border border-gray-300 px-4 py-2">Deductions</th>
                        <th class="border border-gray-300 px-4 py-2">Net Salary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $sal)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($sal->salary_date)->format('d M, Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rs. {{ number_format($sal->basic_salary, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rs. {{ number_format($sal->allowance ?? 0, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rs. {{ number_format($sal->deductions ?? 0, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rs. {{ number_format($sal->net_salary, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
