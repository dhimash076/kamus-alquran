<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kamus Digital Al-Quran') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            .font-arabic { font-family: 'Amiri', serif; }
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    
    <body class="antialiased overflow-hidden" style="background: linear-gradient(135deg, #1a3a2a 0%, #0f2318 50%, #1c2e1c 100%); min-height: 100vh;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative">
            
            {{-- Decorative glowing orbs matching welcome page --}}
            <div class="absolute top-0 right-0 w-80 h-80 rounded-full opacity-10" style="background: radial-gradient(circle, #c9a84c, transparent); transform: translate(30%, -30%);"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 rounded-full opacity-10" style="background: radial-gradient(circle, #c9a84c, transparent); transform: translate(-30%, 30%);"></div>
            {{-- Subtle cross pattern --}}
            <div class="absolute inset-0 opacity-5" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c9a84c' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);"></div>

            {{-- Logo / Branding --}}
            <div class="z-10 text-center mb-8">
                <a href="/" class="group flex flex-col items-center gap-4">
                    <div class="w-20 h-20 rounded-[2rem] flex items-center justify-center transition-transform group-hover:scale-110 duration-500"
                        style="background: rgba(201,168,76,0.1); border: 2px solid rgba(201,168,76,0.3); box-shadow: 0 0 30px rgba(201,168,76,0.15);">
                        <i class="fas fa-book-quran text-3xl" style="color: #c9a84c;"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-black uppercase tracking-[0.3em] text-sm">Kamus Digital</h1>
                        <p class="font-bold text-[10px] uppercase tracking-widest italic" style="color: rgba(201,168,76,0.6);">Al-Quran Sign Language</p>
                    </div>
                </a>
            </div>

            {{-- Card --}}
            <div class="w-full sm:max-w-md px-10 py-12 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.6)] rounded-[3rem] z-10 relative overflow-hidden"
                style="background: #fffdf7; border-bottom: 6px solid #c9a84c;">
                {{-- Decorative icon --}}
                <div class="absolute top-0 right-0 p-4 opacity-5">
                    <i class="fas fa-quran text-6xl rotate-12" style="color: #1a3a2a;"></i>
                </div>

                {{ $slot }}
            </div>

            <div class="mt-8 text-[9px] font-black uppercase tracking-[0.4em] z-10" style="color: rgba(201,168,76,0.4);">
                &copy; 2026 Inklusivitas Untuk Semua
            </div>
        </div>
    </body>
</html>