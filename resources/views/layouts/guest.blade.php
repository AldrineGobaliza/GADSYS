<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GAD System') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800&display=swap" rel="stylesheet" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            /* Modern Animated Mesh / Aurora Background */
            .bg-mesh {
                background-color: #0f0c29; 
                position: relative;
                overflow: hidden;
            }
            
            /* The glowing color orbs */
            .bg-mesh::before, .bg-mesh::after, .bg-mesh-pink {
                content: '';
                position: absolute;
                border-radius: 50%;
                filter: blur(140px); /* Heavy blur for soft, volumetric lighting */
                opacity: 0.6;
                animation: float 20s infinite alternate ease-in-out;
                z-index: 0;
                pointer-events: none; /* Prevents background from blocking clicks */
            }

            /* Deep Purple Orb */
            .bg-mesh::before {
                width: 70vw;
                height: 70vw;
                max-width: 800px;
                max-height: 800px;
                background: #2D1B4E; 
                top: -10%;
                left: -10%;
                animation-delay: 0s;
            }

            /* Teal Orb */
            .bg-mesh::after {
                width: 60vw;
                height: 60vw;
                max-width: 600px;
                max-height: 600px;
                background: #008080; 
                bottom: -10%;
                right: -5%;
                animation-duration: 25s;
            }

            /* Soft Pink Accent Orb */
            .bg-mesh-pink {
                width: 40vw;
                height: 40vw;
                max-width: 500px;
                max-height: 500px;
                background: #FFB6C1; 
                top: 20%;
                left: 30%;
                mix-blend-mode: screen;
                opacity: 0.15; /* Subtle accent */
                animation-duration: 30s;
                animation-direction: alternate-reverse;
            }

            /* The floating animation */
            @keyframes float {
                0% { transform: translate(0, 0) scale(1); }
                50% { transform: translate(5%, 10%) scale(1.1); }
                100% { transform: translate(-5%, 5%) scale(0.9); }
            }

            /* Premium Glassmorphism Card Container */
            .glass-card {
                background: rgba(255, 255, 255, 0.04);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    
    <body class="font-sans text-gray-100 antialiased selection:bg-[#D4AF37] selection:text-[rgb(98,98,168)] bg-mesh min-h-screen">
        
        <div class="bg-mesh-pink"></div>

        <div class="relative z-10 min-h-screen flex flex-col justify-center items-center p-4 sm:p-6">
            
            <div class="mb-8">
                <a href="/" class="transition-transform duration-500 hover:scale-110 inline-block group">
                </a>
            </div>

        <div class="w-full max-w-[440px] px-6 py-10 sm:px-10 glass-card rounded-3xl transition-all duration-500 hover:border-white/20 hover:bg-white/5 shadow-2xl">
            
            {{ $slot }}
            
        </div>
            
            <div class="mt-8 text-sm text-gray-400 opacity-70">
                &copy; {{ date('Y') }} LNU GAD OFFICE All rights reserved.
            </div>
        </div>
    </body>
</html>