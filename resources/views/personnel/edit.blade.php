@extends('layouts.admin')

@section('content')
<h2>Edit Personnel</h2>

<form action="{{ route('personnel.update', $personnel->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $personnel->name }}">
    </div>

    <div class="mb-3">
        <label>Position</label>
        <input type="text" name="position" class="form-control" value="{{ $personnel->position }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $personnel->email }}">
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $personnel->phone }}">
    </div>

    <div class="mb-3">
        <label>Photo</label>
        <input type="file" name="staff_photo" class="form-control">
    </div>

    @if($personnel->staff_photo)
        <img src="{{ asset('storage/'.$personnel->staff_photo) }}" width="120" class="mb-3">
    @endif

    <button class="btn btn-primary">Update</button>
</form>
@endsection