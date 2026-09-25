<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | Kandy Iron Works Control Panel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts & Tailwind Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-[#080d15] text-slate-100 font-sans antialiased selection:bg-amber-500 selection:text-black">

<div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity.duration.300ms
         @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black/80 backdrop-blur-sm lg:hidden"></div>

    <!-- Sidebar Component -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0b121e] border-r border-white/10 flex flex-col justify-between transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">

        <!-- Top Brand Section -->
        <div>
            <div class="h-20 flex items-center justify-between px-6 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-black font-extrabold text-lg shadow-lg shadow-amber-500/20 border border-amber-400/40">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <div>
                        <div class="text-sm font-extrabold tracking-tight text-white uppercase">Kandy <span class="text-amber-500">Iron Works</span></div>
                        <p class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">Management Console</p>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white lg:hidden">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-xs font-semibold">
                <div class="px-3 pb-2 text-[10px] uppercase tracking-wider font-extrabold text-slate-400">Overview</div>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-chart-line text-sm w-5 text-center"></i>
                    <span>Dashboard Metrics</span>
                </a>

                <div class="pt-4 px-3 pb-2 text-[10px] uppercase tracking-wider font-extrabold text-slate-400">Leads &amp; Operations</div>

                <a href="{{ route('admin.inquiries.index') }}"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.inquiries.*') ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-inbox text-sm w-5 text-center"></i>
                        <span>Inquiries &amp; Quotes</span>
                    </div>
                    @php
                        $pendingCount = \App\Models\Inquiry::where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ request()->routeIs('admin.inquiries.*') ? 'bg-black text-amber-400' : 'bg-amber-500/20 text-amber-400 border border-amber-500/40' }}">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>

                <div class="pt-4 px-3 pb-2 text-[10px] uppercase tracking-wider font-extrabold text-slate-400">Catalog &amp; Media</div>

                <a href="{{ route('admin.projects.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.projects.*') ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-images text-sm w-5 text-center"></i>
                    <span>Projects Portfolio</span>
                </a>

                <a href="{{ route('admin.catalog.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.catalog.*') ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-shapes text-sm w-5 text-center"></i>
                    <span>Design Catalog</span>
                </a>

                <a href="{{ route('admin.testimonials.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.testimonials.*') ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-star text-sm w-5 text-center"></i>
                    <span>Customer Reviews</span>
                </a>

                <div class="pt-4 px-3 pb-2 text-[10px] uppercase tracking-wider font-extrabold text-slate-400">Settings</div>

                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-sliders text-sm w-5 text-center"></i>
                    <span>Workshop Settings</span>
                </a>
            </nav>
        </div>

        <!-- Bottom User Section -->
        <div class="p-4 border-t border-white/10 space-y-3">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between p-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-300 transition-colors">
                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-globe text-amber-400"></i>
                    <span>View Public Website</span>
                </span>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400"></i>
            </a>

            <div class="flex items-center justify-between pt-1">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/30 text-amber-400 flex items-center justify-center font-bold text-xs">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="text-xs">
                        <div class="font-bold text-white leading-tight">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-[10px] text-slate-400">Chief Fabricator</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-rose-400 p-2 rounded-lg hover:bg-white/5 transition-colors" title="Sign Out">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- Top Navigation Bar -->
        <header class="h-20 bg-[#0a0f18]/80 backdrop-blur-md border-b border-white/10 px-6 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 lg:hidden">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div>
                    <h1 class="text-lg font-bold text-white tracking-tight">@yield('header_title', 'Dashboard')</h1>
                    <p class="text-xs text-slate-400 hidden sm:block">@yield('header_subtitle', 'Kandy Iron Works Administration')</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.inquiries.index', ['status' => 'pending']) }}" class="relative p-2 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition-colors" title="Pending Leads">
                    <i class="fa-solid fa-bell"></i>
                    @if($pendingCount > 0)
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-amber-500"></span>
                    @endif
                </a>

                <a href="{{ route('admin.projects.create') }}" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold transition-all shadow-glow">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Project</span>
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="m-6 mb-0 bg-emerald-950/80 border border-emerald-500/40 text-emerald-200 p-4 rounded-xl flex items-center justify-between text-xs font-medium backdrop-blur-sm">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="m-6 mb-0 bg-rose-950/80 border border-rose-500/40 text-rose-200 p-4 rounded-xl flex items-center justify-between text-xs font-medium backdrop-blur-sm">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-exclamation text-rose-400 text-base"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Body Content -->
        <main class="p-6 sm:p-8 flex-1">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
