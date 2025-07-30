@extends('layout')

@section('content')
<div class="p-6 bg-white rounded-2xl shadow-xl">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold text-teal-700">📁 Projects Dashboard</h2>

        <form action="{{ route('projects.create') }}" method="GET" class="inline-block">
    <button type="submit"
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    ➕ New Project
  </button>
</form>
    </div>

    {{-- Search and Filters --}}
    <div class="mb-4 flex flex-wrap gap-4 justify-between items-center">
        <input type="text" placeholder="Search projects..."
               class="w-full md:w-1/3 px-4 py-2 border border-teal-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-400">

        <select class="px-4 py-2 border border-teal-300 rounded bg-white focus:outline-none">
            <option>All Statuses</option>
            <option>In Progress</option>
            <option>Completed</option>
            <option>Pending</option>
        </select>
    </div>

    {{-- Projects Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">
        <table class="min-w-full text-sm text-left text-gray-800">
            <thead class="bg-gray-100 text-gray-800 text-sm font-bold uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 border">#</th>
                    <th class="px-4 py-3 border">Title</th>
                    <th class="px-4 py-3 border">Description</th>
                    <th class="px-4 py-3 border">Start Date</th>
                    <th class="px-4 py-3 border">End Date</th>
                    <th class="px-4 py-3 border">Status</th>
                    <th class="px-4 py-3 border">Manager</th>
                    
                    <th class="px-4 py-3 border">Priority</th>
                    <th class="px-4 py-3 border">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($projects as $index => $project)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border font-semibold">{{ $project->title }}</td>
                    <td class="px-4 py-2 border">{{ $project->description }}</td>
                    <td class="px-4 py-2 border">{{ $project->start_date }}</td>
                    <td class="px-4 py-2 border">{{ $project->end_date }}</td>
                    <td class="px-4 py-2 border">
                        <span class="px-2 py-1 rounded-full text-white text-xs font-semibold 
                            @if($project->status == 'Completed') bg-green-400 
                            @elseif($project->status == 'Pending') bg-yellow-400 
                            @elseif($project->status == 'On Hold') bg-red-400 
                            @else bg-blue-500 
                            @endif">
                            {{ $project->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border">{{ $project->manager }}</td>
                    <td class="px-4 py-2 border">{{ $project->priority }}</td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('projects.show', $project->id) }}" class="text-blue-600 hover:underline mr-2">View</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-6 text-gray-500">No projects found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
