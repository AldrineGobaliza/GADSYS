@extends('layouts.public')

@section('content')
<div class="container">
<div class="row align-items-center">

    <div class="col-md-6">

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

                <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
        @endif
    </div>

        <div class="col-md-6">
                    <h1 class="mb-3">{{ $post->title }}</h1>
             
                <p class="text-muted">
                    {{ $post->created_at->format('F d, Y') }}
                </p>

                <p style="line-height: 1.8;">
                    {!! nl2br(e($post->content)) !!}
                </p>
                
                <a href="/" class="btn btn-secondary">
                    ← Back to Posts
                </a>
        </div>
    </div>
</div>
@endsection


