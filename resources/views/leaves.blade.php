@extends('layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">Leave Management</h2>

<!-- 🔹 Apply for Leave -->
<div class="bg-white p-6 rounded-lg shadow-md mb-10">
    <h3 class="text-lg font-semibold mb-4">Apply for Leave</h3>

    <form method="POST" action="{{ route('leaves.store') }}" class="grid md:grid-cols-2 gap-6">
        @csrf
        <div>
            <label class="block font-medium text-sm">Employee</label>
            <select name="employee_id" class="w-full border rounded px-4 py-2">
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium text-sm">Leave Type</label>
            <select name="leave_type" class="w-full border rounded px-4 py-2">
                <option value="sick">Sick</option>
                <option value="casual">Casual</option>
                <option value="earned">Earned</option>
            </select>
        </div>
        <div>
            <label class="block font-medium text-sm">From Date</label>
            <input type="date" name="from_date" class="w-full border px-4 py-2 rounded">
        </div>
        <div>
            <label class="block font-medium text-sm">To Date</label>
            <input type="date" name="to_date" class="w-full border px-4 py-2 rounded">
        </div>
        <div class="md:col-span-2">
            <label class="block font-medium text-sm">Reason</label>
            <textarea name="reason" rows="3" class="w-full border px-4 py-2 rounded"></textarea>
        </div>
        <div class="md:col-span-2 text-right">
            <button type="submit"
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    Submit Request
  </button> </div>
    </form>
</div>

<!-- 🔹 Pending Leave Approvals (Admin Panel) -->
<div class="bg-white p-6 rounded-lg shadow-md mb-10">
    <h3 class="text-lg font-semibold mb-4">Pending Leave Requests</h3>

    <table class="w-full text-sm border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Employee</th>
                <th class="px-4 py-2 border">Type</th>
                <th class="px-4 py-2 border">Dates</th>
                <th class="px-4 py-2 border">Reason</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingLeaves as $leave)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $leave->employee->name }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $leave->leave_type }}</td>
                    <td class="border px-4 py-2">{{ $leave->from_date }} - {{ $leave->to_date }}</td>
                    <td class="border px-4 py-2">{{ $leave->reason }}</td>
                    <td class="border px-4 py-2 capitalize text-orange-500">{{ $leave->status }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <form method="POST" action="{{ route('leaves.approve', $leave->id) }}" class="inline">@csrf
                            <button class="text-green-600 hover:underline">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('leaves.reject', $leave->id) }}" class="inline">@csrf
                            <button class="text-red-600 hover:underline">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if($pendingLeaves->isEmpty())
                <tr><td colspan="6" class="text-center py-4 text-gray-500">No pending requests.</td></tr>
            @endif
        </tbody>
    </table>
</div>

<!-- 🔹 Leave History -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-semibold mb-4">Leave History</h3>

    <!-- Filter -->
    <form method="GET" action="{{ route('leaves.index') }}" class="flex flex-wrap gap-4 mb-4">
        <select name="employee_id" class="border px-3 py-2 rounded">
            <option value="">All Employees</option>
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
            @endforeach
        </select>
        <input type="month" name="month" class="border px-3 py-2 rounded">
        <button class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">Filter</button>
    </form>

    <table class="w-full text-sm border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Employee</th>
                <th class="px-4 py-2 border">Type</th>
                <th class="px-4 py-2 border">Dates</th>
                <th class="px-4 py-2 border">Reason</th>
                <th class="px-4 py-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveHistory as $history)
                <tr>
                    <td class="border px-4 py-2">{{ $history->employee->name }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $history->leave_type }}</td>
                    <td class="border px-4 py-2">{{ $history->from_date }} - {{ $history->to_date }}</td>
                    <td class="border px-4 py-2">{{ $history->reason }}</td>
                    <td class="border px-4 py-2 capitalize text-{{ $history->status == 'approved' ? 'green' : ($history->status == 'rejected' ? 'red' : 'orange') }}-600">
                        {{ ucfirst($history->status) }}
                    </td>
                </tr>
            @endforeach
            @if($leaveHistory->isEmpty())
                <tr><td colspan="5" class="text-center py-4 text-gray-500">No leave records found.</td></tr>
            @endif
        </tbody>
    </table>
</div>

@endsection
