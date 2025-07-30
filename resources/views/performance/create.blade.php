@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-lg mt-8 border border-gray-200">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Employee Performance</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Start --}}
    <form action="{{ route('performance.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Employee Name --}}
        <div>
            <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
            <select name="employee_id" id="employee_id" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Score --}}
        <div>
            <label for="score" class="block text-sm font-medium text-gray-700">Performance Score (out of 100)</label>
            <input type="number" name="score" id="score" max="100" min="0" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500" required>
        </div>

        {{-- Feedback --}}
        <div>
            <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback</label>
            <textarea name="feedback" id="feedback" rows="4" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500" placeholder="Write performance feedback..." required></textarea>
        </div>

        <!-- {{-- Month --}}
        <div>
            <label for="month" class="block text-sm font-medium text-gray-700">Performance Month</label>
            <input type="month" name="month" id="month" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500" required>
        </div> -->

        {{-- Submit --}}
        <div class="text-right">
            <button type="submit"
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    Submit Performance
  </button>

        </div>
    </form>
</div>
@endsection
