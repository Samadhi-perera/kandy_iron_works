@extends('layouts.admin')

@section('title', 'Design Catalog')
@section('header_title', 'Design Pattern Catalog Manager')
@section('header_subtitle', 'Manage standardized architectural models, design codes, and base pricing')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-xs text-slate-400">Total Designs: <strong class="text-white">{{ $items->total() }}</strong></p>
        <a href="{{ route('admin.catalog.create') }}" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold transition-all shadow-glow flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Add Catalog Item</span>
        </a>
    </div>

    <div class="glass-panel rounded-2xl border border-white/10 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-white/5 uppercase text-slate-400 border-b border-white/5 text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Code</th>
                        <th class="py-3.5 px-4">Preview</th>
                        <th class="py-3.5 px-4">Design Title</th>
                        <th class="py-3.5 px-4">Category &amp; Material</th>
                        <th class="py-3.5 px-4">Base Rate (LKR)</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($items as $item)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-amber-400 whitespace-nowrap">
                                {{ $item->code }}
                            </td>
                            <td class="py-3 px-4 w-16">
                                <img src="{{ asset($item->image_url ?? '/images/showcase/luxury_gate.jpg') }}" alt="{{ $item->title }}" class="w-12 h-12 rounded-lg object-cover border border-white/10">
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-white">{{ $item->title }}</div>
                                <div class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $item->description }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/5 text-amber-400 border border-white/10">
                                    {{ $item->category_label }}
                                </span>
                                <div class="text-[11px] text-slate-400 mt-1">{{ $item->material }}</div>
                            </td>
                            <td class="py-3 px-4 font-bold text-white whitespace-nowrap">
                                LKR {{ number_format($item->base_price_lkr) }} <span class="text-slate-400 font-normal text-[10px]">/ {{ $item->price_unit }}</span>
                            </td>
                            <td class="py-3 px-4">
                                @if($item->is_active)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Active</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-500/20 text-slate-400">Disabled</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.catalog.edit', $item->id) }}" class="p-2 rounded-lg bg-white/5 text-slate-300 hover:bg-amber-500 hover:text-black transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('admin.catalog.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this catalog design?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-white/5 text-slate-400 hover:bg-rose-500 hover:text-white transition-colors" title="Delete">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">No catalog designs added.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/5">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
