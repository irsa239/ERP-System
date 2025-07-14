@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 text-green-700">Attendance Record Details</h2>

    <p><strong>Employee:</strong> {{ $attendance->employee->name }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($attendance->date)->format('d M, Y') }}</p>
    <p><strong>Status:</strong>
        <span class="font-semibold
            @if($attendance->status === 'present') text-green-600
            @elseif($attendance->status === 'absent') text-red-600
            @else text-yellow-600
            @endif
        ">
            {{ ucfirst($attendance->status) }}
        </span>
    </p>

    <a href="{{ route('attendance.index') }}" class="inline-block mt-6 px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700">Back to Attendance List</a>
</div>
@endsection
