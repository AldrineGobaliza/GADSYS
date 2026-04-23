<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GAD Office</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    {{-- Navbar --}}
    @include('public.partials.navbar')

    {{-- Main Content --}}
    <main class="container mt-5 mb-5">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('public.partials.footer')

</body>
</html>