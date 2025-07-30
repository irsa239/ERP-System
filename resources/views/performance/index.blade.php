@extends('layout')

@section('content')
<div class="px-8 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee Performance Overview</h1>

    {{-- Search & Filter --}}
    <div class="flex justify-between items-center mb-6">
        <input type="text" placeholder="Search by name..." class="w-1/3 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
        <form action="{{ route('performance.create') }}" method="GET" class="inline-block">
            <button type="submit"
                class="px-6 py-2 rounded hover:opacity-90"
                style="background-color: #07d5b6; color: black; border: 1px solid black;">
                + Add Performance
            </button>
        </form>
    </div>

    {{-- Performance Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($performances as $performance)
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300 border border-gray-200">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $performance->employee->name }}</h2>
                    <span class="text-sm text-gray-500">{{ $performance->month }}</span>
                </div>
                <p class="text-sm text-gray-600 mb-3">Feedback: <span class="italic">{{ Str::limit($performance->feedback, 60) }}</span></p>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-semibold text-green-600">Score: {{ $performance->score }}/100</span>
                    <a href="{{ route('performance.show', $performance->id) }}" class="text-emerald-600 hover:underline text-sm">View Details</a>
                </div>
                
                {{-- Star Rating --}}
                <div class="mt-2 text-yellow-400 text-lg">
                    @php
                        $stars = 0;
                        if ($performance->score <= 20) $stars = 1;
                        elseif ($performance->score <= 40) $stars = 2;
                        elseif ($performance->score <= 60) $stars = 3;
                        elseif ($performance->score <= 80) $stars = 4;
                        else $stars = 5;
                    @endphp
                    @for($i = 0; $i < $stars; $i++)
                        ⭐
                    @endfor
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
