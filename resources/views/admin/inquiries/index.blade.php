@extends('layouts.admin')

@section('title', 'Inquiries & Quote Requests')
@section('header_title', 'Customer Inquiries & Leads CRM')
@section('header_subtitle', 'Manage online quote requests, schedule site visits, and track contract progress')

@section('content')
<div class="space-y-6">
    <!-- Filter Bar & Search -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 glass-panel p-4 rounded-2xl border border-white/10">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center gap-1.5 text-xs font-bold w-full sm:w-auto">
            <a href="{{ route('admin.inquiries.index') }}"
               class="px-3 py-1.5 rounded-lg transition-all {{ empty($status) ? 'bg-amber-500 text-black shadow' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                All ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'pending']) }}"
               class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'pending' ? 'bg-amber-500 text-black shadow' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                Pending ({{ $counts['pending'] }})
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'contacted']) }}"
               class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'contacted' ? 'bg-blue-500 text-white shadow' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                Contacted ({{ $counts['contacted'] }})
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'site_visit']) }}"
               class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'site_visit' ? 'bg-purple-500 text-white shadow' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                Site Visit ({{ $counts['site_visit'] }})
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'quoted']) }}"
               class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'quoted' ? 'bg-cyan-500 text-black shadow' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                Quoted ({{ $counts['quoted'] }})
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'completed']) }}"
               class="px-3 py-1.5 rounded-lg transition-all {{ $status === 'completed' ? 'bg-emerald-500 text-black shadow' : 'bg-white/5 text-slate-300 hover:bg-white/10' }}">
                Completed ({{ $counts['completed'] }})
            </a>
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ route('admin.inquiries.index') }}" class="relative w-full sm:w-64">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search customer, phone..."
                   class="w-full bg-white/5 border border-white/10 rounded-xl pl-9 pr-4 py-2 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-amber-400">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
        </form>
    </div>

    <!-- Table -->
    <div class="glass-panel rounded-2xl border border-white/10 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-white/5 uppercase text-slate-400 border-b border-white/5 text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Date</th>
                        <th class="py-3.5 px-4">Customer</th>
                        <th class="py-3.5 px-4">Service &amp; Dimensions</th>
                        <th class="py-3.5 px-4">Budget / Quote</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Source</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($inquiries as $inq)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">
                                {{ $inq->created_at->format('M d, Y') }}
                                <div class="text-[10px] text-slate-400">{{ $inq->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-white">{{ $inq->name }}</div>
                                <div class="text-slate-400 text-[11px] flex items-center gap-2 mt-0.5">
                                    <a href="tel:{{ $inq->phone }}" class="text-amber-400 hover:underline">{{ $inq->phone }}</a>
                                    @if($inq->location)
                                        <span>&bull; {{ $inq->location }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-semibold text-slate-200">{{ $inq->service_type }}</div>
                                <div class="text-slate-400 text-[11px]">
                                    {{ $inq->dimensions ?? 'No dimensions given' }}
                                    @if($inq->material_preference)
                                        &bull; {{ $inq->material_preference }}
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-amber-400">{{ $inq->estimated_budget ?? '—' }}</div>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $inq->status_badge_class }}">
                                    {{ $inq->formatted_status }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-400 capitalize text-[11px]">
                                {{ str_replace('_', ' ', $inq->source) }}
                            </td>
                            <td class="py-3 px-4 text-right space-x-1 whitespace-nowrap">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}?text=Hello%20{{ urlencode($inq->name) }},%20this%20is%20Eng.%20Sanjaya%20from%20Kandy%20Iron%20Works%20regarding%20your%20inquiry%20for%20{{ urlencode($inq->service_type) }}." target="_blank" class="p-2 rounded-lg bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500 hover:text-white transition-colors" title="WhatsApp Customer">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                </a>
                                <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="p-2 rounded-lg bg-white/5 text-slate-300 hover:bg-amber-500 hover:text-black transition-colors" title="View & Update Inquiry">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
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
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <p class="text-sm">No inquiries matching criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/5">
            {{ $inquiries->links() }}
        </div>
    </div>
</div>
@endsection
