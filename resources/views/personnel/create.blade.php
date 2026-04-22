@extends('layouts.admin')

@section('content')

<h2>Add Personnel</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
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

<form action="{{ route('personnel.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Position</label>
                <input type="text" name="position" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Photo</label>
                <input type="file" name="staff_photo" class="form-control">
            </div>

            <button class="btn btn-success">Save Personnel</button>
        </div>
    </div>
</form>

<hr class="my-5">

<h4>Existing Personnel</h4>

@if($personnel->isEmpty())
    <p class="text-muted">No personnel added yet.</p>
@else
<div class="row">
    @foreach($personnel as $person)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">

                <img src="{{ $person->staff_photo 
                        ? asset('storage/'.$person->staff_photo) 
                        : asset('default.png') }}"
                     class="card-img-top"
                     style="height:180px; object-fit:cover;">

                <div class="card-body text-center">
                    <h6 class="fw-bold mb-1">{{ $person->name }}</h6>
                    <small class="text-muted d-block mb-2">
                        {{ $person->position }}
                    </small>

                    @if($person->email)
                        <small class="d-block">{{ $person->email }}</small>
                    @endif

                    @if($person->phone)
                        <small class="d-block">{{ $person->phone }}</small>
                    @endif

                    <div class="mt-2">
                        <a href="{{ route('personnel.edit', $person->id) }}" 
                           class="btn btn-sm btn-warning">
                           Edit
                        </a>

                        <form action="{{ route('personnel.destroy', $person->id) }}" 
                              method="POST" 
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

@endsection