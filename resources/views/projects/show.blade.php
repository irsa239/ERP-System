@extends('layout')

@section('content')
    <div class="p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-teal-700">📋 Project Details</h2>
        
        <div class="space-y-3 text-gray-800">
            <p><strong>Title:</strong> {{ $project->title }}</p>
            <p><strong>Description:</strong> {{ $project->description }}</p>
            <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
            <p><strong>End Date:</strong> {{ $project->end_date }}</p>
            <p><strong>Status:</strong> {{ $project->status }}</p>
            <p><strong>Manager:</strong> {{ $project->manager }}</p>
            <p><strong>Team Members:</strong> {{ $project->team_members }}</p>
            <p><strong>Priority:</strong> {{ $project->priority }}</p>
        </div>

        <a href="{{ route('projects.index') }}"
           class="mt-4 inline-block text-teal-600 hover:underline">← Back to Projects</a>
    </div>
@endsection
