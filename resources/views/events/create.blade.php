@extends('layout')

@section('title', 'Add New Event')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-0">
    <h2 class="text-xl font-bold mb-4">Add New Event</h2>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Type</label>
            <select name="type" class="w-full border p-2 rounded" required>
                <option value="Birthday">Birthday</option>
                <option value="Anniversary">Work Anniversary</option>
                <option value="Meeting">Meeting</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Event Date</label>
            <input type="date" name="event_date" class="w-full border p-2 rounded" required>
        </div>

        <button
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    Add Event
  </button>
    </form>
</div>
@endsection
