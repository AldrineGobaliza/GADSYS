<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('events', 'public');
            $event->cover_image = $path;
        }

        $event->save();

        return redirect()
            ->route('events.create')
            ->with('success', 'Event added successfully.');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:6144'
        ]);

        if ($request->hasFile('cover_image')) {
            // delete old image if exists
            if ($event->cover_image) {
                Storage::disk('public')->delete($event->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        $event->update($data);

        return redirect()->route('posts.index')
            ->with('success', 'Event updated successfully.');
    }
}
