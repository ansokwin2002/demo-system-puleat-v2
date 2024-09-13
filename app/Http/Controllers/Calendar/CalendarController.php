<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // public function index()
    // {
    //     return view('backend.calendar.index');
    // }
    // Fetch all events
    public function index()
    {
        $events = Event::all();
        return view('backend.calendar.index');
    }

    // Store a new event
    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event);
    }

    // Show a specific event (for editing)
    public function show($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    // Update an event
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->update($request->all());
        return response()->json($event);
    }

    // Delete an event
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
