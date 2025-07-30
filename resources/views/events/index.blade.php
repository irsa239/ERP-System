@extends('layout')

@section('title', 'All Events')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 mt-8 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">All Events</h2>

    @if($events->count())
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $event->title }}</td>
                        <td class="px-4 py-2">{{ $event->type }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No events found.</p>
    @endif
</div>
@endsection
