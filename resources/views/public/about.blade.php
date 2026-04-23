@extends('layouts.public')

@section('content')

<!-- ABOUT SECTION -->
<div class="mb-5">
    <h2>About GAD Office</h2>
    <p>
        The Gender and Development (GAD) Office of the university promotes gender equality,
        inclusivity, and empowerment through programs, policies, and community engagement.
    </p>
</div>

<!-- SERVICES SECTION -->
<div class="mb-5">
    <h3>GAD Services</h3>

    <ul class="list-group mt-3">
        <li class="list-group-item">Gender Sensitivity Training</li>
        <li class="list-group-item">Counseling and Support Services</li>
        <li class="list-group-item">Workshops and Seminars</li>
        <li class="list-group-item">Advocacy Campaigns</li>
        <li class="list-group-item">Policy Development Support</li>
    </ul>
</div>

<!-- PERSONNEL SECTION -->
<div class="mb-4">
    <h3>GAD Personnel</h3>

    <div class="row mt-3">

        @foreach($personnel as $person)

        <div class="col-md-4 col-sm-6 mb-4">

            <div class="card text-center h-100">

                {{-- FIXED: staff_photo --}}
                @if($person->staff_photo)
                    <img 
                        src="{{ asset('storage/'.$person->staff_photo) }}" 
                        class="card-img-top"
                        style="height: 250px; object-fit: cover;"
                    >
                @else
                    <img 
                        src="https://via.placeholder.com/300x250?text=No+Image" 
                        class="card-img-top"
                    >
                @endif

                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $person->name }}</h5>
                        <p class="text-muted">{{ $person->position }}</p>
                        
                        {{-- Optional --}}
                        @if($person->email)
                        <i class="bi bi-envelope-at-fill"></i>
                            <small>{{ $person->email }}</small><br>
                        @endif

                        @if($person->phone)
                        <i class="bi bi-telephone-fill me-1"></i>
                            <small>{{ $person->phone }}</small>
                        @endif
                    </div>

                </div>

            </div>

        @endforeach

    </div>
</div>

@endsection