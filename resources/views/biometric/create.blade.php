@extends('layout')

@section('content')
<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Add Biometric Attendance</h2>

    <form method="POST" action="{{ route('biometric.store') }}">
        @csrf

        <div class="mb-4">
            <label>Employee</label>
            <select name="employee_id" class="w-full border p-2">
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Date</label>
            <input type="date" name="date" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label>Time In</label>
            <input type="time" name="time_in" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label>Time Out</label>
            <input type="time" name="time_out" class="w-full border p-2">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
