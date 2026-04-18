@extends('layouts.admin')

@section('content')
<h2>Edit Post</h2>

<div class="card mt-3">
    <div class="card-body">

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="5" class="form-control" required>{{ $post->content }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Event Date</label>
                <input type="date" name="event_date" class="form-control" value="{{ $post->event_date }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" width="100" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>

    </div>
</div>
@endsection