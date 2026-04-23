@extends('layouts.public')

@section('content')

<h2 class="mb-4">GAD Events</h2>

<div class="row">

    @forelse($events as $event)

    <div class="col-md-6 mb-4">

        <div class="card h-100">

            {{-- Image --}}
            @if($event->cover_image)
                <img 
                    src="{{ asset('storage/'.$event->cover_image) }}" 
                    class="card-img-top"
                    style="height: 200px; object-fit: cover;"
                >
            @endif

            <div class="card-body">

                {{-- Title --}}
                <h5 class="card-title">{{ $event->title }}</h5>

                {{-- Date --}}
                <p class="text-muted mb-1">
                    <i class="bi bi-calendar3"></i>
                     {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
                </p>

                {{-- Time --}}
                @if($event->start_time && $event->end_time)
                <p class="text-muted mb-1">
                    <i class="bi bi-clock-fill"></i>
                     {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }} -                      {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                </p>
                @endif

                {{-- Location --}}
                <p class="text-muted mb-2">
                    <i class="bi bi-geo-alt-fill"></i>
                     {{ $event->location }}
                </p>

                {{-- Description --}}
                <p class="card-text">
                    {{ Str::limit($event->description, 100) }}
                </p>

            </div>

        </div>

    </div>

    @empty

    <p>No events available.</p>

    @endforelse

</div>

@endsection