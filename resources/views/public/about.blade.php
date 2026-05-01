@extends('layouts.public')

@section('content')

<!-- ABOUT SECTION -->
<div class="text-center mb-3">
    <h2 class="text-center mb-3 fw-bold" >About GAD</h2>
    <p>
The principle of equality between men and women is enshrined in the Philippine Constitution, to wit: The State recognizes the role of women in nation building, and shall ensure the fundamental equality before the law of women and men (from the 1987 Philippine Constitution; Article II, Section 14.)
 
Thus, on July 2, 2010, the Commission on Higher Education approved the CHED Special Order creating the GAD program in coordination with Philippine Commission for Women to undertake all necessary and appropriate mechanisms to advance the cause of GAD in all Higher Education Institutions, including State Colleges and Universities like the Leyte Normal University.

The office is mandated by law to adhere with these policies and directives thus; the creation of these GAD Services:
    </p>
</div>

<!-- SERVICES SECTION -->
<div class="gad-services position-relative py-5">
    <h3 class="text-center mb-5 fw-bold">Our Services</h3>

    <div class="timeline-line"></div>

    @php
        $services = [
            [
                'title' => 'Gender-Based Violence Prevention',
                'description' => 'We would like to ensure that students, faculty and staff of the university shall be protected from any gender-based violence or even against discrimination.',
                'icon' => 'bi-people-fill'
            ],
            [
                'title' => 'Support Services',
                'description' => 'We would like to ensure that students, faculty and staff of the university shall be protected from any gender-based violence or even against discrimination.',
                'icon' => 'bi-heart-fill'
            ],
            [
                'title' => 'Gender Sensitivity Trainings',
                'description' => 'We already initiated various workshops, and seminars attended by our faculty and students like Gender Equality and Women Empowerment, Safe Spaces Act, Pulso han Kababayin-an or VAWC; Integrating Gender-Responsive Education in the Curriculum, the Pre Deployment Orientation Seminar of OJT (CME and CAS) and Practicum Students (COE) on Sexual Abuse and Exploitation in the Workplace.',
                'icon' => 'bi-mic-fill'
            ],
            [
                'title' => 'Gender Mainstreaming',
                'description' => 'This is one of the major strategies in educating and informing various sectors of society on the need to recognize and respect the rights of women, men and members of the LGBTQ community so that everybody will benefit equally and inequality is not perpetuated.',
                'icon' => 'bi-file-earmark-text-fill'
            ],
            [
                'title' => 'Gender-Neutral Facilities and Policies',
                'description' => 'The office would like to imbibe GAD Principles in the Engineering Designs, Layouts and Plans for the facilities of the university with inclusive GAD demands like the gender-neutral comfort rooms for our transgender students and lesbians and ramp for PWD students. All the buildings at the Young field area like the ILS, New Academic, Dormitories, Conversion, Health and Wellness Center, also the Research Extension and Innovation Center in Candahug, Palo and the new Learning Resource Center at the College building are in compliance with these principles. The space for toddlers and breastfeeding area for our lactating mothers (for students, faculty and personnel) will also be furnished at the Health and Wellness Center.',
                'icon' => 'bi-megaphone-fill'
            ],

            [
            'title' => 'Gender Research and Advocacy',
                'description' => 'In the realization of relevant and responsive research in the university, the Research office aims at generating, or applying new knowledge and technologies for improving productivity, promoting peace, empowering women, protecting the environment and alleviating poverty. Appropriate to this mission, faculty members and students of the university shall conduct gender-related researches addressing issues in relation to the aforementioned concerns. That is why when you take your Research subject, you are also encouraged to conduct gender and women’s studies.',
                'icon' => 'bi-file-earmark-text-fill'
            ],

            [
                'title' => 'Gender-Responsive Curriculum Development',
                'description' => 'To ensure the gender responsiveness of curricular programs, the GAD office would collaborate with academic departments to enhance gender mainstreaming strategies, curricular designs, learning materials and pedagogical practices that would address gender-related topics across disciplines like crafting of syllabus and instructional materials (IMs)/modules incorporating human rights and gender sensitive language concepts.',
                'icon' => 'bi-file-earmark-text-fill'
            ],
        ];
    @endphp

    <div class="container">
        @foreach($services as $index => $service)
            <div class="row align-items-center mb-5 service-item" x-data="{ open: false }">

                {{-- LEFT SIDE --}}
                <div class="col-md-5 text-md-end">
                    @if($index % 2 == 0)
                        <div class="service-card" >
                            <h5 class="mb-0">{{ $service['title'] }}</h5>
                        </div>
                        
                        <div class="service-card " x-show="open" x-transition>
                            <p class="mb-0 text-muted">{{ $service['description'] }}</p>
                        </div>

                    @endif
                </div>

                {{-- CENTER ICON --}}
                <div class="col-md-2 text-center">
                    <div 
                        class="icon-wrapper clickable"
                        @click="open = !open"
                    >
                        <i class="bi {{ $service['icon'] }}"></i>
                    </div>
                </div>

                {{-- RIGHT SIDE --}}
                <div class="col-md-5 text-md-start">
                    @if($index % 2 != 0)
                        <div class="service-card">
                            <h5 class="mb-0">{{ $service['title'] }}</h5>
                        </div>
                        <div class="service-card" x-show="open" x-transition>
                            <p class="mb-0 text-muted">{{ $service['description'] }}</p>
                        </div>
                    @endif
                </div>

            </div>
        @endforeach
    </div>
</div>

<!-- PERSONNEL SECTION -->
<div class="container py-5">
    <h3 class="text-center mb-5 fw-bold">GAD Personnel</h3>

    <div class="row">
        @foreach($personnel as $person)
        <div class="col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

            <div class="flip-card">
                <div class="flip-card-inner">

                    {{-- FRONT --}}
                    <div class="flip-card-front text-center">
                        <img 
                            src="{{ $person->staff_photo ? asset('storage/'.$person->staff_photo) : 'https://via.placeholder.com/300x250?text=No+Image' }}" 
                            class="profile-img">
                        <h5 class="text-center mt-2 name-fit">{{ $person->name }}</h5>
                        <p class="card-text-muted">{{ $person->position }}</p>
                        <p class="small mt-2">
                            <span class="flip-icon">
                                <i class="bi bi-arrow-left-right"></i>
                            </span> 
                        </p>
                    </div>

                    {{-- BACK --}}
                    <div class="flip-card-back text-center">
                        <h5>Contact Info</h5>

                        @if($person->email)
                            <p class="mb-1">
                                <i class="bi bi-envelope-at-fill"></i>
                                <small>{{ $person->email }}</small>
                            </p>
                        @endif

                        @if($person->phone)
                            <p>
                                <i class="bi bi-telephone-fill"></i>
                                <small>{{ $person->phone }}</small>
                            </p>
                        @endif

                        <div class="mt-3">
                            <small class="text-muted"></small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>

@endsection