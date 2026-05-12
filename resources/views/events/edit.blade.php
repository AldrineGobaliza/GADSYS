@extends('layouts.admin')

@section('content')
<h2>Edit Event</h2>

<div class="card mt-3">
    <div class="card-body">

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Event Title</label>
                <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control" required>{{ $event->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Event Date</label>
                <input type="date" name="event_date" class="form-control" value="{{ $event->event_date }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Start Time</label>
                <input type="time" name="start_time" class="form-control" value="{{ $event->start_time }}">
            </div>

            <div class="mb-3">
                <label class="form-label">End Time</label>
                <input type="time" name="end_time" class="form-control" value="{{ $event->end_time }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cover Image</label>
                <input type="file" name="cover_image" class="form-control" value="{{ $event->cover_image }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>

    </div>
</div>
@endsection