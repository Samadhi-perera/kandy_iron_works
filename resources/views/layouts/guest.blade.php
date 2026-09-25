<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kandy Iron Works') }} - Staff Portal</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#080d15] text-slate-100 font-sans antialiased selection:bg-amber-500 selection:text-black">
    <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 bg-forge-gradient">
        <div class="mb-6 text-center">
            <a href="/" class="inline-flex flex-col items-center gap-2 group">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-black font-extrabold text-2xl shadow-glow border border-amber-400/40 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-fire"></i>
                </div>
                <div class="mt-1">
                    <div class="text-xl font-extrabold tracking-tight text-white uppercase">Kandy <span class="text-amber-500">Iron Works</span></div>
                    <p class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">Administrative Access Portal</p>
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md glass-panel p-8 rounded-3xl border border-white/10 shadow-2xl">
            {{ $slot }}
        </div>

        <div class="mt-6 text-center text-xs text-slate-500">
            <a href="/" class="text-amber-400 hover:underline">&larr; Return to Public Website</a>
        </div>
    </div>
</body>
</html>
