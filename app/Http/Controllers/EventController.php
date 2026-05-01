<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

public function index()
{
    $events = Event::latest()->get();
    return view('events.index', compact('events'));
}

public function create()
{
    return view('events.create');
}

public function store(Request $request)
{
    $event = new Event();

    $event->title = $request->title;
    $event->description = $request->description;
    $event->start_time = $request->start_time;
    $event->end_time = $request->end_time;
    $event->event_date = $request->event_date;
    $event->location = $request->location;

    if($request->hasFile('cover_image')){
        $path = $request->file('cover_image')->store('events','public');
        $event->cover_image = $path;
    }

    $event->save();

    return redirect()
        ->route('events.create')
         ->with('success', 'Event added successfully.');
}

}
