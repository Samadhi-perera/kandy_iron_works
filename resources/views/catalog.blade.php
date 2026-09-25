@extends('layouts.public')

@section('title', 'Design Pattern Catalog | Kandy Iron Works')
@section('meta_description', 'Browse standard architectural gate designs, spiral stair balustrades, steel canopies and window grills with reference design codes and rates.')

@section('content')
<div class="py-16 bg-[#070b11] border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="max-w-3xl space-y-4 mb-12">
            <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Standardized Models</span>
            <h1 class="text-4xl sm:text-5xl font-black text-white uppercase tracking-tight">Design Pattern Catalog</h1>
            <p class="text-slate-400 text-sm leading-relaxed">
                Standardized patterns with proven durability, exact material specifications, and fixed base pricing per square foot. Quote the code for rapid fabrication.
            </p>
        </div>

        <!-- Filter Navigation -->
        <div class="flex flex-wrap items-center gap-2 mb-10 pb-4 border-b border-white/10 text-xs font-bold">
            <a href="{{ route('catalog') }}" class="px-4 py-2.5 rounded-xl transition-all {{ empty($category) ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                All Designs ({{ \App\Models\CatalogItem::where('is_active', true)->count() }})
            </a>
            <a href="{{ route('catalog', ['category' => 'gates']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'gates' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-door-closed mr-1"></i> Driveway Gates
            </a>
            <a href="{{ route('catalog', ['category' => 'railings']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'railings' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-stairs mr-1"></i> Railings &amp; Stairs
            </a>
            <a href="{{ route('catalog', ['category' => 'roofing']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'roofing' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-warehouse mr-1"></i> Roofing &amp; Canopies
            </a>
            <a href="{{ route('catalog', ['category' => 'grills']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'grills' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-shield-halved mr-1"></i> Window Grills
            </a>
            <a href="{{ route('catalog', ['category' => 'furniture']) }}" class="px-4 py-2.5 rounded-xl transition-all {{ $category === 'furniture' ? 'bg-amber-500 text-black shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                <i class="fa-solid fa-chair mr-1"></i> Steel Furniture
            </a>
        </div>

        <!-- Catalog Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($items as $item)
                <div class="glass-panel rounded-2xl overflow-hidden border border-white/5 hover:border-amber-400/40 transition-all duration-300 flex flex-col group shadow-xl">
                    <div class="relative h-48 overflow-hidden bg-black">
                        <img src="{{ asset($item->image_url ?? '/images/showcase/luxury_gate.jpg') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-black/80 backdrop-blur-md text-amber-400 border border-amber-400/30">
                            {{ $item->code }}
                        </span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="text-[10px] text-amber-400 font-bold uppercase tracking-wide">{{ $item->category_label }}</div>
                            <h4 class="text-sm font-bold text-white mt-1 group-hover:text-amber-400 transition-colors line-clamp-1">{{ $item->title }}</h4>
                            <div class="text-xs text-slate-400 mt-0.5"><strong class="text-slate-300">Material:</strong> {{ $item->material }}</div>
                            <p class="text-xs text-slate-400 mt-2 line-clamp-2 leading-relaxed">{{ $item->description }}</p>
                        </div>

                        <div class="pt-3 border-t border-white/5 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block">Base Price</span>
                                <strong class="text-xs font-bold text-amber-400">LKR {{ number_format($item->base_price_lkr) }} / {{ $item->price_unit }}</strong>
                            </div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}?text=Hello%20{{ urlencode($settings['workshop_name'] ?? 'Kandy Iron Works') }},%20I%20would%20like%20to%20order%20Design%20Code:%20{{ $item->code }}%20({{ urlencode($item->title) }})." target="_blank" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-[11px] font-bold transition-colors flex items-center gap-1">
                                <i class="fa-brands fa-whatsapp text-sm"></i> Order
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-16 text-slate-400">
                    No catalog items found in this category.
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
