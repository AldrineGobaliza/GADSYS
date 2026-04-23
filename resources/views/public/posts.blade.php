@extends('layouts.public')

@section('content')

<div class="row">

    <!-- MAIN CONTENT -->
    <div class="col-md-8">

        <!-- Title -->
        <h1 class="mb-3">{{ $post->title }}</h1>

        <!-- Date -->
        <p class="text-muted">
            {{ $post->created_at->format('F d, Y') }}
        </p>

        <!-- Images -->
        @if($post->images->count())
            <div id="postCarousel" class="carousel mb-4 carouesel-fade" data-bs-ride="true" data-bs-interval="2000">
                
                <div class="carousel-indicators">
                    @foreach($post->images as $index => $image)
                        <button 
                            type="button" 
                            data-bs-target="#postCarousel" 
                            data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}">
                        </button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach($post->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img 
                                src="{{ asset('storage/'.$image->image_path) }}" 
                                class="d-block w-100 rounded"

                                alt="Post Image {{ $index + 1 }}"
                            >
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
        @endif

        <!-- Content -->
        <div class="mb-5">
            <p style="line-height: 1.8;">
                {!! nl2br(e($post->content)) !!}
            </p>
        </div>

        <!-- Back Button -->
        <a href="/" class="btn btn-secondary">
            ← Back to Posts
        </a>

    </div>

</div>

@endsection