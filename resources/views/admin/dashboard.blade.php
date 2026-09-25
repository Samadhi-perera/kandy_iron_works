@extends('layouts.admin')

@section('title', 'Control Center')
@section('header_title', 'Workshop Control Center')
@section('header_subtitle', 'Real-time overview of incoming inquiries, active fabrications, and media')

@section('content')
<div class="space-y-8">
    <!-- Stat Counters Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Pending Leads -->
        <div class="glass-panel p-5 rounded-2xl border border-amber-500/30 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Pending Inquiries</span>
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-base">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mt-3">{{ $stats['pending_inquiries'] }}</div>
            <div class="text-[11px] text-slate-400 mt-1 flex items-center justify-between">
                <span>Requires phone/WhatsApp callback</span>
                <a href="{{ route('admin.inquiries.index', ['status' => 'pending']) }}" class="text-amber-400 hover:underline font-bold">Review &rarr;</a>
            </div>
        </div>

        <!-- Card 2: Site Visits Scheduled -->
        <div class="glass-panel p-5 rounded-2xl border border-purple-500/30 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-purple-400">Site Visits Scheduled</span>
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center text-base">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mt-3">{{ $stats['site_visits'] }}</div>
            <div class="text-[11px] text-slate-400 mt-1 flex items-center justify-between">
                <span>Laser measurement appointments</span>
                <a href="{{ route('admin.inquiries.index', ['status' => 'site_visit']) }}" class="text-purple-400 hover:underline font-bold">View &rarr;</a>
            </div>
        </div>

        <!-- Card 3: Active Quotes Sent -->
        <div class="glass-panel p-5 rounded-2xl border border-cyan-500/30 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">Quotes Issued</span>
                <div class="w-10 h-10 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center text-base">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mt-3">{{ $stats['active_quotes'] }}</div>
            <div class="text-[11px] text-slate-400 mt-1 flex items-center justify-between">
                <span>Awaiting client contract advance</span>
                <a href="{{ route('admin.inquiries.index', ['status' => 'quoted']) }}" class="text-cyan-400 hover:underline font-bold">Track &rarr;</a>
            </div>
        </div>

        <!-- Card 4: Showcase Projects & Media -->
        <div class="glass-panel p-5 rounded-2xl border border-emerald-500/30 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Portfolio &amp; Catalog</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-base">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mt-3">{{ $stats['total_projects'] }} <span class="text-sm font-normal text-slate-400">/ {{ $stats['catalog_items'] }} models</span></div>
            <div class="text-[11px] text-slate-400 mt-1 flex items-center justify-between">
                <span>Published on live website</span>
                <a href="{{ route('admin.projects.index') }}" class="text-emerald-400 hover:underline font-bold">Manage &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Main Section: Recent Inquiries Table & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Inquiries Table (8 cols) -->
        <div class="lg:col-span-8 glass-panel rounded-2xl border border-white/10 overflow-hidden shadow-xl">
            <div class="p-5 border-b border-white/10 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-sm text-white">Recent Customer Inquiries &amp; Estimator Leads</h3>
                    <p class="text-xs text-slate-400">Latest quotation requests submitted by homeowners and contractors</p>
                </div>
                <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-amber-400 hover:underline">View All Leads &rarr;</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-white/5 uppercase text-slate-400 border-b border-white/5 text-[10px] tracking-wider">
                        <tr>
                            <th class="py-3 px-4">Customer</th>
                            <th class="py-3 px-4">Service &amp; Location</th>
                            <th class="py-3 px-4">Est. Budget</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($recentInquiries as $inq)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="py-3 px-4">
                                    <div class="font-bold text-white">{{ $inq->name }}</div>
                                    <div class="text-slate-400 text-[11px] flex items-center gap-2 mt-0.5">
                                        <a href="tel:{{ $inq->phone }}" class="hover:text-amber-400">{{ $inq->phone }}</a>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-semibold text-slate-200">{{ $inq->service_type }}</div>
                                    <div class="text-slate-400 text-[11px]">{{ $inq->location ?? 'Kandy' }} &bull; {{ $inq->dimensions ?? 'N/A' }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-amber-400">{{ $inq->estimated_budget ?? 'Needs Quote' }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $inq->status_badge_class }}">
                                        {{ $inq->formatted_status }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right space-x-1 whitespace-nowrap">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}?text=Hello%20{{ urlencode($inq->name) }},%20this%20is%20Eng.%20Sanjaya%20from%20Kandy%20Iron%20Works%20regarding%20your%20inquiry%20for%20{{ urlencode($inq->service_type) }}." target="_blank" class="p-1.5 rounded-lg bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500 hover:text-white transition-colors" title="Chat on WhatsApp">
                                        <i class="fa-brands fa-whatsapp text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="p-1.5 rounded-lg bg-white/5 text-slate-300 hover:bg-amber-500 hover:text-black transition-colors" title="Manage Inquiry">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">No inquiries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Side: Quick Shortcuts & Showcase Previews (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Quick Actions Card -->
            <div class="glass-panel p-5 rounded-2xl border border-white/10 space-y-4">
                <h4 class="font-bold text-sm text-white flex items-center gap-2">
                    <i class="fa-solid fa-bolt text-amber-400"></i>
                    <span>Quick Actions</span>
                </h4>

                <div class="space-y-2 text-xs">
                    <a href="{{ route('admin.projects.create') }}" class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 text-slate-200 transition-colors border border-white/5">
                        <span class="flex items-center gap-2.5">
                            <i class="fa-solid fa-plus text-amber-400"></i>
                            <span>Upload New Project Photo</span>
                        </span>
                        <i class="fa-solid fa-angle-right text-slate-400"></i>
                    </a>

                    <a href="{{ route('admin.catalog.create') }}" class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 text-slate-200 transition-colors border border-white/5">
                        <span class="flex items-center gap-2.5">
                            <i class="fa-solid fa-shapes text-amber-400"></i>
                            <span>Add Design Catalog Item</span>
                        </span>
                        <i class="fa-solid fa-angle-right text-slate-400"></i>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 text-slate-200 transition-colors border border-white/5">
                        <span class="flex items-center gap-2.5">
                            <i class="fa-solid fa-phone text-amber-400"></i>
                            <span>Update Workshop Phone &amp; Hours</span>
                        </span>
                        <i class="fa-solid fa-angle-right text-slate-400"></i>
                    </a>
                </div>
            </div>

            <!-- Recent Projects Preview -->
            <div class="glass-panel p-5 rounded-2xl border border-white/10 space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="font-bold text-sm text-white">Showcase Projects</h4>
                    <a href="{{ route('admin.projects.index') }}" class="text-xs text-amber-400 hover:underline">Manage</a>
                </div>

                <div class="space-y-3 text-xs">
                    @foreach($recentProjects as $p)
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-white/5 border border-white/5">
                            <img src="{{ asset($p->image_url) }}" class="w-12 h-12 rounded-lg object-cover">
                            <div class="flex-1 min-w-0">
                                <h5 class="font-bold text-white truncate text-xs">{{ $p->title }}</h5>
                                <p class="text-[11px] text-amber-400">{{ $p->category_label }} &bull; {{ $p->location }}</p>
                            </div>
                            <a href="{{ route('admin.projects.edit', $p->id) }}" class="text-slate-400 hover:text-white p-1">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
