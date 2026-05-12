@extends('layouts.admin')

@section('content')
<h2>Personnel Management</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('personnel.create') }}" class="btn btn-primary mb-3">
    Add Personnel
</a>

@endsection