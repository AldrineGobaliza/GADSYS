@extends('layouts.admin')

@section('content')
<h2>Personnel Management</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('personnel.create') }}" class="btn btn-primary mb-3">
    Add Personnel
</a>

<div class="row">
@foreach($personnel as $person)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">

            <img src="{{ $person->staff_photo ? asset('storage/'.$person->staff_photo) : asset('default.png') }}" 
                 class="card-img-top"
                 style="height:200px; object-fit:cover;">

            <div class="card-body text-center">
                <h5>{{ $person->name }}</h5>
                <p class="text-muted">{{ $person->position }}</p>

                <a href="{{ route('personnel.edit', $person->id) }}" 
                   class="btn btn-sm btn-warning">Edit</a>

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
@endforeach
</div>
@endsection