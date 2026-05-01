@extends('layouts.admin')

@section('content')

<h2>Documents</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<div class="card mt-3">
    <div class="card-body">

        {{-- Upload --}}
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf

            <div class="mb-3">
                <input class="form-control" type="file" name="file[]" multiple required>
            </div>

            <select name="folder_id" class="form-control mb-2">
                <option value="">No Folder</option>

                @foreach($folders as $folder)
                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                @endforeach
            </select>

            <button class="btn btn-primary">Upload Document</button>
            
        </form>

        <form action="{{ route('folders.store') }}" method="POST" class="mb-3">
            @csrf

            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="New Folder Name">
                <button class="btn btn-secondary">Create Folder</button>
            </div>
        </form>

        <form method="GET" class="row mb-3">

        <div class="col-md-4">
            <input type="text" name="search" class="form-control" 
                            value="{{ request('search') }}" 
                            placeholder="Search file...">
        </div>

        <div class="col-md-4">
            <select name="folder_id" class="form-control">
                <option value="">All Folders</option>

                @foreach($folders as $folder)
                    <option value="{{ $folder->id }}" 
                        {{ request('folder_id') == $folder->id ? 'selected' : '' }}>
                        {{ $folder->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="col-auto">
            <button class="btn btn-primary">Filter</button>
        </div>

    </form>

        {{-- Table --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Date</th>
                    <th>Folder</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($documents as $doc)
                <tr>
                    <td>{{ $doc->file_name }}</td>
                    <td>@if($doc->file_size < 1024)
                            {{ $doc->file_size }} B
                        @elseif($doc->file_size < 1048576)
                            {{ round($doc->file_size / 1024, 2) }} KB
                        @else
                            {{ round($doc->file_size / 1048576, 2) }} MB
                        @endif
                    </td>
                    <td>{{ $doc->created_at->format('M d, Y') }}</td>
                    <td>{{ $doc->folder->name ?? 'Uncategorized' }}</td>

                    <td>

                        <a href="{{ route('documents.download', $doc->id) }}" class="btn btn-sm btn-success">
                            Download
                        </a>

                        <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this file?')">
                                    Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No documents uploaded</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection