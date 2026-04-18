@extends('layouts.admin')

@section('content')
<h2>Manage Posts</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row mt-4">
    @foreach($posts as $post)
    <div class="col-md-4 mb-4 shadow p-1">
        <div class="card shadow-sm">

            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="text-muted">
                    {{ $post->event_date ?? 'No event date' }}
                </p>
                <p class="card-text">
                    {{ $post->content }}
                </p>

@php
$images = $post->images;
$total = $images->count();
@endphp

<div class="mb-3 d-flex content-center" style="gap:5px;">

    @foreach($images->take(4) as $index => $image)
        <div style="position: relative;">

                 <img src="{{ asset('storage/'.$image->image_path) }}" 
                 style="width:100px; height:100px; object-fit:cover;"
                 class="rounded">
                    
            {{-- Show "+X more" on 4th image --}}
            @if($index == 3 && $total > 4)
                <div 
                    data-bs-toggle="modal" 
                    data-bs-target="#imageModal{{ $post->id }}"
                    style="
                        position:absolute;
                        top:0;
                        left:0;
                        width:100%;
                        height:100%;
                        background:rgba(0,0,0,0.6);
                        color:white;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:20px;
                        font-weight:bold;
                        cursor:pointer;
                    ">
                    +{{ $total - 4 }}
                </div>
            @endif

        </div>
    @endforeach
</div>

<!-- Images Modal -->
<div class="modal fade" id="imageModal{{ $post->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $post->id }}" aria-hidden="true" >
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

                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">
                    Edit
                </a>

                <form action="{{ route('posts.destroy', $post->id) }}" 
                      method="POST" 
                      style="display:inline-block;">
                    @csrf

                    @method('DELETE') 
                    <button 
                        type="button" 
                        class="btn btn-sm btn-danger"
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal{{ $post->id }}">
                        Delete
                    </button>
                </form>

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

                    <!-- ✅ Actual delete form inside modal -->
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
@endsection