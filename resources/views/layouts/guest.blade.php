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
    
    <body class="bg-slate-950 antialiased overflow-hidden">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative">
            
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/20 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-600/10 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2"></div>

            <div class="z-10 text-center mb-8">
                <a href="/" class="group flex flex-col items-center gap-4">
                    <div class="w-20 h-20 bg-slate-900 border-2 border-blue-500 rounded-[2rem] flex items-center justify-center shadow-[0_0_30px_rgba(37,99,235,0.3)] transition-transform group-hover:scale-110 duration-500">
                        <i class="fas fa-book-quran text-3xl text-blue-400"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-black uppercase tracking-[0.3em] text-sm">Kamus Digital</h1>
                        <p class="text-blue-500 font-bold text-[10px] uppercase tracking-widest italic">Al-Quran Sign Language</p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-10 py-12 bg-white shadow-[0_35px_60px_-15px_rgba(0,0,0,0.6)] rounded-[3rem] z-10 border-b-8 border-blue-600 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5">
                    <i class="fas fa-quran text-6xl rotate-12"></i>
                </div>

                {{ $slot }}
            </div>

            <div class="mt-8 text-slate-600 text-[9px] font-black uppercase tracking-[0.4em] z-10">
                &copy; 2026 Inklusivitas Untuk Semua
            </div>
        </div>
    </body>
</html>