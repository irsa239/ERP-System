@extends('layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-8">
    <h2 class="text-2xl font-bold mb-4">Self Performance Evaluation - {{ $month }} {{ $year }}</h2>

    @if($existingScore)
        <p class="text-green-600">✅ Aap ne is month ka performance score already diya hai.</p>
        <p><strong>Score:</strong> {{ $existingScore->score }}/100</p>
        <p><strong>Rating:</strong> {{ $existingScore->rating }}</p>
        <p><strong>Remarks:</strong> {{ $existingScore->remarks }}</p>
    @else
        <form method="POST" action="{{ route('performance.self.store') }}">
            @csrf
            <input type="hidden" name="employee_id" value="{{ $employeeId }}">
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $year }}">

            <div class="mb-4">
                <label class="block font-medium">Score (0-100)</label>
                <input type="number" name="score" class="w-full border p-2 rounded" min="0" max="100" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Rating</label>
                <select name="rating" class="w-full border p-2 rounded">
                    <option value="⭐">⭐</option>
                    <option value="⭐⭐">⭐⭐</option>
                    <option value="⭐⭐⭐">⭐⭐⭐</option>
                    <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                    <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Remarks</label>
                <textarea name="remarks" class="w-full border p-2 rounded"></textarea>
            </div>

            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">Submit Evaluation</button>
        </form>
    @endif
</div>
@endsection
