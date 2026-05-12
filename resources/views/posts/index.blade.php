@extends('layouts.admin')

@section('content')
<h2>Manage Posts</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row g-4 mt-2">
    @foreach($posts as $post)
    <div class="col-lg-4 col-md-6">

        <div class="post-card h-100">

            {{-- HEADER --}}
            <div class="post-card-header">
                <h5 class="post-title">{{ $post->title }}</h5>
                <small class="post-date">
                    <i class="bi bi-calendar-event"></i>
                    {{ $post->event_date ?? 'No event date' }}
                </small>
            </div>

            {{-- BODY --}}
            <div class="post-card-body">
                <p class="post-content">
                    {{ Str::limit($post->content, 120) }}
                </p>

                @php
                $images = $post->images;
                $total = $images->count();
                @endphp

                @if($total)
                <div class="image-grid">

                    @foreach($images->take(4) as $index => $image)
                    <div class="image-wrapper">

                        <img src="{{ asset('storage/'.$image->image_path) }}">

                        @if($index == 3 && $total > 4)
                        <div
                            class="image-overlay"
                            data-bs-toggle="modal"
                            data-bs-target="#imageModal{{ $post->id }}">
                            +{{ $total - 4 }}
                        </div>
                        @endif

                    </div>
                    @endforeach

                </div>
                @endif
            </div>

            {{-- FOOTER --}}
            <div class="post-card-footer">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-light btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <button
                    class="btn btn-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal{{ $post->id }}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>

        </div>

    </div>

    <div class="modal fade" id="imageModal{{ $post->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $post->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel{{ $post->id }}">All Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-2 justify-content-center">
                        @foreach($images as $image)
                        <img src="{{ asset('storage/'.$image->image_path) }}"
                            style="width:150px; height:150px; object-fit:cover; cursor:pointer;"
                            class="rounded shadow-sm">
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">
                        Confirm Delete
                        {{ $post->title }}?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this post? This action cannot be undone.
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<hr class="my-5">
<h2>Manage Events</h2>

<div class="row g-4 mt-2">
    @foreach($events as $event)
    <div class="col-lg-4 col-md-6">

        <div class="post-card h-100">

            {{-- HEADER --}}
            <div class="post-card-header">
                <h5 class="post-title">{{ $event->title }}</h5>
            </div>

            {{-- BODY --}}
            <div class="card-body">
                {{-- Image --}}
                @if($event->cover_image)
                <img
                    src="{{ asset('storage/'.$event->cover_image) }}"
                    class="card-img-top"
                    style=" object-fit: cover;">
                @endif

                {{-- Date --}}
                <p class="text-muted mb-1">
                    <i class="bi bi-calendar3"></i>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
                </p>

                {{-- Time --}}
                @if($event->start_time && $event->end_time)
                <p class="text-muted mb-1">
                    <i class="bi bi-clock-fill"></i>
                    {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                </p>
                @endif

                {{-- Location --}}
                <p class="text-muted mb-2">
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $event->location }}
                </p>

                {{-- Description --}}
                <p class="card-text">

                    <span id="desc-{{ $event->id }}">
                        {{ Str::limit($event->description, 100) }}
                    </span>

                    <a href="#"
                        class="toggle-desc d-block mt-1"
                        data-id="{{ $event->id }}"
                        data-full="{{ $event->description }}">
                        Read More
                    </a>

                </p>

            </div>

            <div class="post-card-footer">
                <td>{{ $event->created_at->format('M d, Y') }}</td>

                <a href="{{ route('events.edit', $event->id) }}"
                    class="btn btn-light btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <button
                    class="btn btn-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteEventModal{{ $event->id }}">
                    <i class="bi bi-trash"></i>
                </button>

            </div>

        </div>

        <div class="modal fade" id="deleteEventModal{{ $event->id }}" tabindex="-1">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Delete {{ $event->title }}?
                        </h5>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this event?
                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form action="{{ route('events.destroy', $event->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">
                                Delete
                            </button>

                        </form>

                    </div>

                </div>
            </div>

        </div>
        @endforeach
    </div>
    @endsection