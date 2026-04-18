@extends('layouts.app') <!-- we'll create a simple public layout -->

@section('content')
<div class="container mt-5">

    <h1 class="mb-4 text-center">GAD Office Events</h1>

    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="text-muted">
                        {{ $post->event_date ?? 'No event date' }}
                    </p>
                    <p class="card-text">{{ $post->content }}</p>

                    <div class="mb-3">
                        @foreach($post->images as $image)
                            <img src="{{ asset('storage/'.$image->image_path) }}" width="100" class="me-2 mb-2 rounded">
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection