@extends('layout')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-teal-700">✏️ Edit Project</h2>

    <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Title:</label>
            <input type="text" name="name" value="{{ $project->name }}"
                   class="w-full px-4 py-2 border rounded border-teal-300 focus:outline-none focus:ring-2 focus:ring-teal-400">
        </div>

        <div>
            <label class="block font-semibold">Description:</label>
            <textarea name="description" class="w-full px-4 py-2 border rounded border-teal-300 focus:outline-none focus:ring-2 focus:ring-teal-400">{{ $project->description }}</textarea>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block font-semibold">Start Date:</label>
                <input type="date" name="start_date" value="{{ $project->start_date }}"
                       class="w-full px-4 py-2 border rounded border-teal-300 focus:outline-none">
            </div>
            <div class="flex-1">
                <label class="block font-semibold">End Date:</label>
                <input type="date" name="end_date" value="{{ $project->end_date }}"
                       class="w-full px-4 py-2 border rounded border-teal-300 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block font-semibold">Status:</label>
            <select name="status" class="w-full px-4 py-2 border rounded border-teal-300">
                <option {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option {{ $project->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Manager:</label>
            <input type="text" name="manager" value="{{ $project->manager }}"
                   class="w-full px-4 py-2 border rounded border-teal-300 focus:outline-none">
        </div>

        <div>
            <label class="block font-semibold">Team Members:</label>
            <input type="text" name="team_members" value="{{ $project->team_members }}"
                   class="w-full px-4 py-2 border rounded border-teal-300 focus:outline-none">
        </div>

        <div>
            <label class="block font-semibold">Priority:</label>
            <input type="text" name="priority" value="{{ $project->priority }}"
                   class="w-full px-4 py-2 border rounded border-teal-300 focus:outline-none">
        </div>

        <button type="submit"
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
     ✅ Update Project
  </button>
    </form>
</div>
@endsection
