@extends('layout')

@section('content')
<div class="p-6 bg-white rounded-2xl shadow-md space-y-8 max-w-6xl mx-auto mt-6">

    {{-- Header --}}
    <div class="flex justify-between items-center border-b pb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Performance Overview – {{ $employee->name }}</h2>
            <p class="text-sm text-gray-500">Month: {{ now()->format('F Y') }}</p>
        </div>
        <a href="{{ route('performance.download', $employee->id) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
            Download PDF Report
        </a>
    </div>

    {{-- Scorecard --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 p-6 rounded-xl shadow-inner">
            <p class="text-lg font-medium text-gray-700">Performance Score</p>
            <div class="text-4xl font-bold text-blue-800 mt-2">{{ $total }}/100</div>
            <div class="text-2xl mt-2">{{ $rating }}</div>
        </div>

        {{-- Smart Suggestions --}}
        <div class="bg-green-50 p-6 rounded-xl shadow-inner">
            <p class="text-lg font-medium text-gray-700 mb-2">System Suggestion:</p>
            @if($total >= 90)
                <p class="text-green-700 font-semibold">Eligible for Promotion 🎉</p>
            @elseif($total >= 75)
                <p class="text-green-600 font-semibold">Keep up the Good Work 👍</p>
            @elseif($total >= 50)
                <p class="text-yellow-600 font-semibold">Training Recommended 📚</p>
            @else
                <p class="text-red-600 font-semibold">Warning Issued ❗</p>
            @endif
        </div>
    </div>

    {{-- Manager Feedback --}}
<div class="bg-yellow-50 p-6 rounded-xl shadow-inner">
    <p class="text-lg font-medium text-gray-700 mb-2">Manager Feedback</p>
    @php
        $latestScore = $employee->performanceScores->where('month', now()->format('F Y'))->last();
    @endphp

    @if($latestScore && $latestScore->remarks)
        <p class="text-gray-800">{{ $latestScore->remarks }}</p>
    @else
        <p class="text-gray-500 italic">No feedback submitted for this month.</p>
    @endif
</div>


    {{-- Trend Chart --}}
    <div class="bg-white border rounded-xl p-4 shadow">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Performance Trend (Last 6 Months)</h3>
        <canvas id="performanceChart" class="w-full h-48"></canvas>
    </div>

    {{-- Warnings Section --}}
    @if($employee->warnings->count())
        <div class="bg-red-50 p-4 rounded-xl border border-red-200">
            <h4 class="text-red-700 font-bold mb-2">⚠️ Warnings Issued</h4>
            <ul class="list-disc pl-6 text-red-600 text-sm">
                @foreach($employee->warnings as $warn)
                    <li>Warning {{ $warn->warning_number }} - {{ $warn->reason }} ({{ $warn->date }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Self Evaluation Form --}}
    <div class="bg-gray-50 p-6 rounded-xl shadow">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Monthly Self-Evaluation Form</h3>
        <form method="POST" action="{{ route('self.evaluate') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
            <input type="hidden" name="month" value="{{ now()->format('F Y') }}">

            <div>
                <label class="block font-medium text-gray-600">Rate Your Performance (1–5)</label>
                <select name="self_rating" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-600">Challenges Faced</label>
                <textarea name="challenges" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-600">Goals for Next Month</label>
                <textarea name="goals" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
            </div>

           <button
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    Submit Evaluation
  </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('performanceChart');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Performance Score',
                    data: @json($scores),
                    backgroundColor: 'rgba(34, 197, 94, 0.6)',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    });
</script>
@endsection

