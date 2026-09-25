<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Kandy Iron Works | Master Metal Craftsmanship & Automated Gates')</title>
    <meta name="description" content="@yield('meta_description', 'Kandy Iron Works – Premier metal fabrication, automated wrought iron gates, modern spiral stairs, structural steel canopies & laser-cut architectural screens in Kandy, Sri Lanka.')">
    <meta name="keywords" content="iron works Kandy, wrought iron gates Sri Lanka, automated gates Kandy, metal fabrication Sri Lanka, steel roofing Kandy, spiral stairs, laser cut screens">

    <!-- OpenGraph / Social Meta -->
    <meta property="og:title" content="Kandy Iron Works | Master Metal Craftsmanship">
    <meta property="og:description" content="Precision engineered gates, railings, roof canopies & custom steelwork crafted with 10-year rust guarantee in Central Province.">
    <meta property="og:image" content="{{ asset('images/showcase/hero_forge.jpg') }}">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23f59e0b'><path d='M21 7.28V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v2.28c-.6.35-1 .98-1 1.72 0 1.1.9 2 2 2h1v9c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2v-9h1c1.1 0 2-.9 2-2 0-.74-.4-1.37-1-1.72zM15 19H9v-8h6v8z'/></svg>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts and CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#070b11] text-slate-100 font-sans antialiased selection:bg-amber-500 selection:text-black">

    <!-- Top Announcement & Contact Bar -->
    <div class="bg-iron-900 border-b border-white/5 py-2 px-4 text-xs font-medium text-slate-400">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-4 flex-wrap">
                <span class="flex items-center gap-1.5 text-amber-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Central Province Workshop Open</span>
                </span>
                <span class="hidden md:inline-flex items-center gap-1 text-slate-400">
                    <i class="fa-solid fa-location-dot text-amber-500"></i>
                    {{ $settings['address'] ?? 'No. 142, William Gopallawa Mw, Kandy' }}
                </span>
                <span class="hidden lg:inline-flex items-center gap-1 text-slate-400">
                    <i class="fa-solid fa-clock text-amber-500"></i>
                    {{ $settings['working_hours'] ?? 'Mon-Sat: 8:00 AM – 6:30 PM' }}
                </span>
            </div>
            <div class="flex items-center gap-4">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone_primary'] ?? '+94812234567') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-phone text-amber-500"></i>
                    <span>{{ $settings['phone_primary'] ?? '+94 81 223 4567' }}</span>
                </a>
                <span class="text-white/20">|</span>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}?text=Hello%20{{ urlencode($settings['workshop_name'] ?? 'Kandy Iron Works') }},%20I%20would%20like%20to%20inquire%20about%20a%20project." target="_blank" class="text-emerald-400 hover:text-emerald-300 transition-colors flex items-center gap-1 font-semibold">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>WhatsApp</span>
                </a>
                @auth
                    <span class="text-white/20">|</span>
                    <a href="{{ route('admin.dashboard') }}" class="text-amber-400 hover:underline flex items-center gap-1">
                        <i class="fa-solid fa-shield-halved text-xs"></i>
                        <span>Admin</span>
                    </a>
                @else
                    <span class="text-white/20">|</span>
                    <a href="{{ route('login') }}" class="text-slate-400 hover:text-white transition-colors">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header x-data="{ mobileOpen: false, scrolled: false }"
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="scrolled ? 'bg-[#0a0f18]/90 backdrop-blur-md shadow-2xl border-white/10' : 'bg-transparent border-transparent'"
            class="sticky top-0 z-50 transition-all duration-300 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Monogram & Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <div class="relative w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center shadow-lg shadow-amber-500/25 border border-amber-400/40 group-hover:scale-105 transition-transform duration-300">
                        <i class="fa-solid fa-fire text-black text-xl"></i>
                        <span class="absolute -bottom-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-black"></span>
                    </div>
                    <div>
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-xl font-extrabold tracking-tight text-white uppercase group-hover:text-amber-400 transition-colors">Kandy</span>
                            <span class="text-xl font-extrabold tracking-tight text-amber-500 uppercase">Iron Works</span>
                        </div>
                        <p class="text-[10px] font-medium tracking-wider uppercase text-slate-400 -mt-0.5">Architectural Steel &bull; Est. 2008</p>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="text-slate-200 hover:text-amber-400 transition-colors {{ request()->routeIs('home') ? 'text-amber-400' : '' }}">Home</a>
                    <a href="{{ route('home') }}#services" class="text-slate-300 hover:text-amber-400 transition-colors">Services</a>
                    <a href="{{ route('portfolio') }}" class="text-slate-300 hover:text-amber-400 transition-colors {{ request()->routeIs('portfolio') ? 'text-amber-400' : '' }}">Portfolio</a>
                    <a href="{{ route('catalog') }}" class="text-slate-300 hover:text-amber-400 transition-colors {{ request()->routeIs('catalog') ? 'text-amber-400' : '' }}">Design Catalog</a>
                    <a href="{{ route('calculator') }}" class="relative text-amber-400 hover:text-amber-300 transition-colors flex items-center gap-1.5 {{ request()->routeIs('calculator') ? 'font-bold' : '' }}">
                        <i class="fa-solid fa-calculator text-xs"></i>
                        <span>Cost Estimator</span>
                        <span class="bg-amber-500/20 text-amber-300 text-[10px] px-1.5 py-0.5 rounded-full border border-amber-500/30">Live</span>
                    </a>
                    <a href="{{ route('contact') }}" class="text-slate-300 hover:text-amber-400 transition-colors {{ request()->routeIs('contact') ? 'text-amber-400' : '' }}">Contact</a>
                </nav>

                <!-- Action Button -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('calculator') }}" class="relative group px-5 py-2.5 rounded-xl font-semibold text-xs uppercase tracking-wider overflow-hidden bg-gradient-to-r from-amber-500 to-amber-600 text-black hover:shadow-glow transition-all duration-300 transform hover:-translate-y-0.5">
                        <span class="relative z-10 flex items-center gap-2 font-bold">
                            <i class="fa-solid fa-file-invoice"></i>
                            <span>Get Free Estimate</span>
                        </span>
                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button @click="mobileOpen = !mobileOpen" type="button" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 focus:outline-none" aria-label="Toggle Navigation">
                        <i class="fa-solid" :class="mobileOpen ? 'fa-xmark text-xl' : 'fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileOpen" x-transition.origin.top.duration.200ms
             @click.away="mobileOpen = false"
             class="md:hidden bg-[#0c121d] border-b border-white/10 px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-200 hover:bg-white/5 hover:text-amber-400">Home</a>
            <a href="{{ route('home') }}#services" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-200 hover:bg-white/5 hover:text-amber-400">Services</a>
            <a href="{{ route('portfolio') }}" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-200 hover:bg-white/5 hover:text-amber-400">Portfolio Showcase</a>
            <a href="{{ route('catalog') }}" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-200 hover:bg-white/5 hover:text-amber-400">Design Catalog</a>
            <a href="{{ route('calculator') }}" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-base font-semibold text-amber-400 bg-amber-500/10 border border-amber-500/20">
                <i class="fa-solid fa-calculator mr-2"></i> Cost Estimator Tool
            </a>
            <a href="{{ route('contact') }}" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-200 hover:bg-white/5 hover:text-amber-400">Contact & Workshop Map</a>

            <div class="pt-3 border-t border-white/10 flex flex-col gap-2">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone_primary'] ?? '+94812234567') }}" class="flex items-center justify-center gap-2 py-2.5 rounded-lg bg-white/5 text-sm font-semibold text-white">
                    <i class="fa-solid fa-phone text-amber-400"></i> Call {{ $settings['phone_primary'] ?? '+94 81 223 4567' }}
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}" target="_blank" class="flex items-center justify-center gap-2 py-2.5 rounded-lg bg-emerald-600 text-sm font-semibold text-white">
                    <i class="fa-brands fa-whatsapp text-lg"></i> Direct WhatsApp
                </a>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 7000)"
             class="fixed top-24 right-5 z-50 max-w-md bg-emerald-950/95 border border-emerald-500/50 text-emerald-200 p-4 rounded-xl shadow-2xl backdrop-blur-md flex items-start gap-3 animate-bounce">
            <i class="fa-solid fa-circle-check text-emerald-400 text-xl mt-0.5"></i>
            <div class="flex-1">
                <h4 class="font-bold text-sm text-emerald-300">Request Sent Successfully!</h4>
                <p class="text-xs text-emerald-200 mt-1 leading-relaxed">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-emerald-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 7000)"
             class="fixed top-24 right-5 z-50 max-w-md bg-rose-950/95 border border-rose-500/50 text-rose-200 p-4 rounded-xl shadow-2xl backdrop-blur-md flex items-start gap-3">
            <i class="fa-solid fa-circle-exclamation text-rose-400 text-xl mt-0.5"></i>
            <div class="flex-1">
                <h4 class="font-bold text-sm text-rose-300">Notice</h4>
                <p class="text-xs text-rose-200 mt-1 leading-relaxed">{{ session('error') }}</p>
            </div>
            <button @click="show = false" class="text-rose-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    @endif

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Floating WhatsApp Quick Button -->
    <div class="fixed bottom-6 right-6 z-40">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}?text=Hi%20{{ urlencode($settings['workshop_name'] ?? 'Kandy Iron Works') }}!%20I%20would%20like%20a%20quotation%20for%20my%20iron%20work%20project." target="_blank"
           class="group relative flex items-center justify-center w-14 h-14 bg-emerald-500 hover:bg-emerald-400 text-white rounded-full shadow-2xl shadow-emerald-500/40 hover:scale-110 transition-all duration-300 focus:outline-none"
           title="Chat on WhatsApp">
            <i class="fa-brands fa-whatsapp text-3xl"></i>
            <span class="absolute -top-1 -right-1 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-[#070b11]"></span>
            </span>
            <span class="absolute right-16 top-2.5 px-3 py-1.5 rounded-lg bg-iron-900 border border-white/10 text-xs font-semibold text-slate-200 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 shadow-xl pointer-events-none">
                WhatsApp Us Directly
            </span>
        </a>
    </div>

    <!-- Main Footer -->
    <footer class="bg-[#05080e] border-t border-white/10 pt-16 pb-10 text-slate-400 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-white/5">
                <!-- Col 1: Bio -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-black font-extrabold text-lg shadow-lg">
                            <i class="fa-solid fa-fire"></i>
                        </div>
                        <span class="text-xl font-extrabold text-white tracking-tight uppercase">Kandy <span class="text-amber-500">Iron Works</span></span>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                        {{ $settings['about_snippet'] ?? 'Premier metal fabricator and architectural wrought iron smiths serving Kandy, Matale, Kurunegala, Nuwara Eliya, and all of Sri Lanka since 2008. Heavy-duty engineering meets timeless artistry.' }}
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <span class="px-3 py-1 rounded-md bg-white/5 border border-white/10 text-[11px] font-semibold text-amber-400">
                            <i class="fa-solid fa-shield-halved mr-1"></i> {{ $settings['warranty_years'] ?? '10-Year Rust Guarantee' }}
                        </span>
                        <span class="px-3 py-1 rounded-md bg-white/5 border border-white/10 text-[11px] font-semibold text-slate-300">
                            <i class="fa-solid fa-certificate mr-1"></i> Certified Welders
                        </span>
                    </div>
                    <div class="flex items-center gap-3 pt-2 text-slate-400">
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-amber-500 hover:text-black flex items-center justify-center transition-colors"><i class="fa-brands fa-facebook-f text-xs"></i></a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-amber-500 hover:text-black flex items-center justify-center transition-colors"><i class="fa-brands fa-instagram text-xs"></i></a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}" target="_blank" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-whatsapp text-xs"></i></a>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone_primary'] ?? '+94812234567') }}" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-amber-500 hover:text-black flex items-center justify-center transition-colors"><i class="fa-solid fa-phone text-xs"></i></a>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="space-y-3">
                    <h5 class="text-white font-bold text-xs uppercase tracking-wider">Quick Navigation</h5>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Home Page</a></li>
                        <li><a href="{{ route('portfolio') }}" class="hover:text-amber-400 transition-colors">Project Portfolio</a></li>
                        <li><a href="{{ route('catalog') }}" class="hover:text-amber-400 transition-colors">Design Pattern Catalog</a></li>
                        <li><a href="{{ route('calculator') }}" class="hover:text-amber-400 transition-colors text-amber-400 font-semibold">Cost Estimator Tool</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-amber-400 transition-colors">Book Free Site Visit</a></li>
                        <li><a href="{{ route('login') }}" class="text-slate-500 hover:text-slate-300 transition-colors">Staff Login</a></li>
                    </ul>
                </div>

                <!-- Col 3: Services -->
                <div class="space-y-3">
                    <h5 class="text-white font-bold text-xs uppercase tracking-wider">Metalwork Services</h5>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('portfolio', ['category' => 'gates']) }}" class="hover:text-amber-400 transition-colors">Automated Driveway Gates</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'railings']) }}" class="hover:text-amber-400 transition-colors">Spiral Stairs &amp; Balustrades</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'roofing']) }}" class="hover:text-amber-400 transition-colors">Cantilever Canopies &amp; Roofs</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'laser_cut']) }}" class="hover:text-amber-400 transition-colors">CNC Laser-Cut Privacy Panels</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'structural']) }}" class="hover:text-amber-400 transition-colors">Industrial Steel Warehouses</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'custom']) }}" class="hover:text-amber-400 transition-colors">Burglar-Proof Window Grills</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Workshop -->
                <div class="space-y-3">
                    <h5 class="text-white font-bold text-xs uppercase tracking-wider">Kandy Workshop</h5>
                    <ul class="space-y-2.5 text-xs">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-amber-500 mt-1"></i>
                            <span>{{ $settings['address'] ?? 'No. 142, William Gopallawa Mawatha, Kandy, Sri Lanka' }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-amber-500"></i>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone_primary'] ?? '+94812234567') }}" class="hover:text-white">{{ $settings['phone_primary'] ?? '+94 81 223 4567' }}</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}" target="_blank" class="hover:text-white">{{ $settings['phone_mobile'] ?? ($settings['whatsapp_number'] ?? '+94 77 123 4567') }}</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-amber-500"></i>
                            <a href="mailto:{{ $settings['email'] ?? 'info@kandyironworks.com' }}" class="hover:text-white">{{ $settings['email'] ?? 'info@kandyironworks.com' }}</a>
                        </li>
                        <li class="flex items-center gap-2 text-slate-400">
                            <i class="fa-solid fa-clock text-amber-500"></i>
                            <span>{{ $settings['working_hours'] ?? 'Mon-Sat: 8:00 AM – 6:30 PM' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Subfooter -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} {{ $settings['workshop_name'] ?? 'Kandy Iron Works' }}. All rights reserved. Registered Metal Fabricator in Central Province, Sri Lanka.</p>
                <div class="flex items-center gap-6">
                    <span>Privacy Policy</span>
                    <span>Terms of Fabrication</span>
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-amber-400 transition-colors">Admin Portal</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
