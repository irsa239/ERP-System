@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-purple-700">Leave Request Details</h2>

    <p><strong>Employee:</strong> {{ $leave->employee->name }}</p>
    <p><strong>Leave Type:</strong> {{ ucfirst($leave->leave_type) }}</p>
    <p><strong>From:</strong> {{ \Carbon\Carbon::parse($leave->from_date)->format('d M, Y') }}</p>
    <p><strong>To:</strong> {{ \Carbon\Carbon::parse($leave->to_date)->format('d M, Y') }}</p>
    <p><strong>Reason:</strong> {{ $leave->reason }}</p>
    <p><strong>Status:</strong>
        <span class="font-semibold
            @if($leave->status === 'approved') text-green-600
            @elseif($leave->status === 'rejected') text-red-600
            @else text-yellow-600
            @endif
        ">
            {{ ucfirst($leave->status) }}
        </span>
    </p>

    <a href="{{ route('leaves.index') }}" class="inline-block mt-6 px-5 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Back to Leaves</a>
</div>
@endsection
