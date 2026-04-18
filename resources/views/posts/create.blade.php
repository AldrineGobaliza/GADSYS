@extends('layouts.admin')

@section('content')
<h2>Create New Post</h2>

<div class="card mt-3">
    <div class="card-body">

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="5" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Event Date</label>
                <input type="date" name="event_date" class="form-control">
            </div>

           <div class="mb-3">
                <label class="form-label">Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
           </div>

            <button type="submit" class="btn btn-primary">Publish Post</button>

        </form>

    </div>
</div>
@endsection