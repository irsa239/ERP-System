@extends('layout')
@section('content')
<div class="max-w-4xl mx-auto mt-2 bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-teal-600">Add New Project</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold text-gray-700">Title</label>
            <input type="text" name="title" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" required>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Description</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-700">Start Date</label>
                <input type="date" name="start_date" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div>
                <label class="block font-semibold text-gray-700">End Date</label>
                <input type="date" name="end_date" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
            </div>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Manager</label>
            <input type="text" name="manager" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Team Members</label>
            <textarea name="team_members" rows="3" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Priority</label>
            <select name="priority" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">Select Priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="pt-4">
           <button type="submit"
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    Save Project
  </button>
  
        </div>
    </form>
</div>
@endsection
