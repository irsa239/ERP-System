@extends('layout')

@section('content')
<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Biometric Attendance List</h2>

    @if(session('success'))
        <div class="text-green-500">{{ session('success') }}</div>
    @endif

    <a href="{{ route('biometric.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Attendance</a>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Employee</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Time In</th>
                <th class="border px-4 py-2">Time Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td class="border px-4 py-2">{{ $attendance->employee->name ?? 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $attendance->date }}</td>
                <td class="border px-4 py-2">{{ $attendance->time_in }}</td>
                <td class="border px-4 py-2">{{ $attendance->time_out }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
