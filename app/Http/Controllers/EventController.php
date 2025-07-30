<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Show all events
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('events.index', compact('events'));
    }

    // Show event create form
    public function create()
    {
        return view('events.create');
    }

    // Store new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'event_date' => 'required|date',
        ]);

        Event::create([
            'title' => $request->title,
            'type' => $request->type,
            'event_date' => $request->event_date,
            'employee_id' => null // Optional: link to employee later
        ]);

        return redirect()->route('dashboard')->with('success', 'Event added successfully!');
    }
}
