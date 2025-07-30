@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-lg mt-8 border border-gray-200">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Employee Performance</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Start --}}
    <form action="{{ route('performance.update', $performance->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Employee Name (disabled) --}}
        <div>
            <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
            <select disabled class="mt-1 block w-full px-4 py-2 border rounded-md bg-gray-100">
                <option>{{ $performance->employee->name }}</option>
            </select>
        </div>

        {{-- Score --}}
        <div>
            <label for="score" class="block text-sm font-medium text-gray-700">Performance Score (out of 100)</label>
            <input type="number" name="score" id="score" max="100" min="0" value="{{ $performance->score }}"
                class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500" required>
        </div>

        {{-- Feedback --}}
        <div>
            <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback</label>
            <textarea name="feedback" id="feedback" rows="4"
                class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500"
                required>{{ $performance->feedback }}</textarea>
        </div>

        {{-- Month --}}
        <div>
            <label for="month" class="block text-sm font-medium text-gray-700">Performance Month</label>
            <input type="month" name="month" id="month" value="{{ \Carbon\Carbon::parse($performance->month)->format('Y-m') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500" required>
        </div>

        {{-- Submit --}}
        <div class="text-right">
            <button type="submit"
                class="bg-emerald-600 text-white px-6 py-2 rounded-lg hover:bg-emerald-700 shadow">
                Update Performance
            </button>
        </div>
    </form>
</div>
@endsection
