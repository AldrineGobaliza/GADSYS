<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GAD Office</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .gad-services {
            background: #f9fafb;
        }

        /* Vertical center line */
        .timeline-line {
            position: absolute;
            top: 100px;
            bottom: 0;
            left: 50%;
            width: 3px;
            background: linear-gradient(to bottom, #0d6efd, #6ea8fe);
            transform: translateX(-50%);
            z-index: 0;
        }

        /* Card */
        .service-card {
            max-width: 500px;
            background: #ffffff;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        /* Icon */
        .icon-wrapper {
            width: 60px;
            height: 60px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 1.5rem;
            z-index: 1;
            position: relative;
            box-shadow: 0 5px 15px rgba(13,110,253,0.4);
        }

        .flip-card {
            width: 100%;
            max-width: 280px;
            height: 400px;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        /* Front & Back */
        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            backface-visibility: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 20px;
            background: #fff;
        }

        /* Front */
        .flip-card-front {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Back */
        .flip-card-back {
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Image */
        .profile-img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            border-radius: 100%;
        }

        /* Small animation */
        .flip-icon {
            display: inline-block;
            animation: wave 1.5s infinite;
        }

        @keyframes wave {
            0% { transform: rotate(0deg); }
            20% { transform: rotate(15deg); }
            40% { transform: rotate(-10deg); }
            60% { transform: rotate(15deg); }
            80% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }

        /* Responsive (mobile) */
        @media (max-width: 768px) {
            .timeline-line {
                left: 20px;
            }

            .service-item {
                flex-direction: column;
            }

            .icon-wrapper {
                margin: 10px 0;
            }
            .clickable {
                cursor: pointer;
                transition: transform 0.2s ease;
            }

            .clickable:hover {
                transform: scale(1.1);
            }

        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('public.partials.navbar')

    {{-- Main Content --}}
    <main class="container mt-3 mb-3">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('public.partials.footer')

</body>
</html>

<script>
    document.querySelectorAll('.toggle-desc').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const id = this.dataset.id;
            const desc = document.getElementById('desc-' + id);

            if (this.textContent === 'Read More') {
                desc.textContent = this.dataset.full;
                this.textContent = 'Read Less';
            } else {
                desc.textContent = this.dataset.full.substring(0, 100) + '...';
                this.textContent = 'Read More';
            }
        });
    });
</script>