@extends('layouts.public')

@section('content')

<div class="text-center py-4 mt-5 bg-light rounded-3">
    <div class="container py-5">
        <h1 class="display-5 fw-bold">Gender and Development Office</h1>
        <p class=" fs-5">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
        </p>
    </div>
</div>

<div class="row">

    <!-- LEFT: POSTS -->
    <div class="col-md-8">

        @foreach($posts as $post)

        <div class="card mb-4 shadow-sm border-0">
            @if($post->images->first())
                <img src="{{ asset('storage/'.$post->images->first()->image_path) }}" class="card-img-top">
            @endif

            <div class="card-body">
                <h3>{{ $post->title }}</h3>

                <p>{{ Str::limit($post->content, 150) }}</p>

                <a href="/posts/{{ $post->id }}" class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                    Read More
                </a>
            </div>
        </div>

        @endforeach

    </div>

    <div class="col-md-4 ">

        <div class="p-3">
            <h4>Upcoming Events</h4>

            @foreach($events as $event)
                <p>
                    <strong>{{ $event->title }}</strong><br>
                    <small>{{ $event->event_date }}</small>
                
                    <a href="/events/{{ $event->event }}" class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                        Read More
                    </a>
                </p>

            @endforeach
        </div>

    </div>

</div>



@endsection