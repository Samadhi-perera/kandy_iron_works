@extends('layouts.public')

@section('title', 'Project Portfolio | Kandy Iron Works')
@section('meta_description', 'Explore our handcrafted metalwork projects: automated wrought iron gates, spiral staircases, cantilever canopies, and CNC laser cut screens in Kandy, Sri Lanka.')

@section('content')
<div class="py-16 bg-[#070b11] border-b border-white/5" x-data="{ selectedImage: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb & Header -->
        <div class="max-w-3xl space-y-4 mb-12">
            <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Fabrication Gallery</span>
            <h1 class="text-4xl sm:text-5xl font-black text-white uppercase tracking-tight">Our Completed Projects</h1>
            <p class="text-slate-400 text-sm leading-relaxed">
                Browse our real-world metalwork installations across Central Province. Every project represents heavy-duty structural engineering, precision TIG/MIG welding, and fine artistic finishing.
            </p>
        </div>

        <!-- Filter Navigation -->
        <div class="flex flex-wrap items-center gap-2 mb-10 pb-4 border-b border-white/10 text-xs font-bold">
            <a href="{{ route('portfolio') }}" class="px-4 py-2.5 rounded-xl transition-all {{ empty($category) ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                All Projects ({{ \App\Models\Project::count() }})
            </a>
            <a href="{{ route('portfolio', ['category' => 'gates']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'gates' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-door-closed mr-1"></i> Driveway Gates
            </a>
            <a href="{{ route('portfolio', ['category' => 'railings']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'railings' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-stairs mr-1"></i> Stairs &amp; Railings
            </a>
            <a href="{{ route('portfolio', ['category' => 'roofing']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'roofing' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-warehouse mr-1"></i> Roof Canopies
            </a>
            <a href="{{ route('portfolio', ['category' => 'laser_cut']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'laser_cut' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-border-all mr-1"></i> CNC Laser-Cut
            </a>
            <a href="{{ route('portfolio', ['category' => 'structural']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'structural' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-industry mr-1"></i> Structural Steel
            </a>
        </div>

        <!-- Project Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <div class="group glass-panel rounded-2xl overflow-hidden border border-white/10 hover:border-amber-500/40 transition-all duration-300 flex flex-col shadow-xl">
                    <div class="relative h-64 overflow-hidden cursor-pointer" @click="selectedImage = '{{ asset($project->image_url) }}'">
                        <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0f18] via-transparent to-transparent opacity-80"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-lg text-[10px] font-extrabold uppercase tracking-wider bg-black/70 backdrop-blur-md text-amber-400 border border-amber-400/30">
                            {{ $project->category_label }}
                        </span>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/40 backdrop-blur-xs">
                            <span class="w-12 h-12 rounded-full bg-amber-500 text-black flex items-center justify-center shadow-lg"><i class="fa-solid fa-expand text-lg"></i></span>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-amber-400 font-medium mb-1">
                                <i class="fa-solid fa-location-dot text-[11px]"></i>
                                <span>{{ $project->location ?? 'Kandy, Sri Lanka' }}</span>
                                <span class="text-white/20">&bull;</span>
                                <span class="text-slate-400">{{ $project->completed_year }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors leading-snug">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed mt-2">
                                {{ $project->description }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Client: <strong class="text-slate-200">{{ $project->client_name ?? 'Private Client' }}</strong></span>
                            <a href="{{ route('home') }}#estimator" class="text-amber-400 hover:text-white font-bold flex items-center gap-1">Quote Similar <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-slate-400">
                    <p class="text-base">No projects found in this category.</p>
                    <a href="{{ route('portfolio') }}" class="text-amber-400 hover:underline mt-2 inline-block">View all projects</a>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $projects->links() }}
        </div>

        <!-- Lightbox Modal -->
        <div x-show="selectedImage" x-transition.opacity.duration.200ms
             @click="selectedImage = null"
             class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4">
            <div class="relative max-w-4xl max-h-[90vh]">
                <img :src="selectedImage" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain border border-white/20">
                <button @click="selectedImage = null" class="absolute -top-12 right-0 text-white hover:text-amber-400 text-2xl font-bold">
                    <i class="fa-solid fa-xmark"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
