@extends('layouts.admin')

@section('title', 'Inquiry Details #' . $inquiry->id)
@section('header_title', 'Inquiry Lead #' . $inquiry->id)
@section('header_subtitle', 'Customer request review, status updates, and workshop logs')

@section('content')
<div class="max-w-5xl space-y-6">
    <!-- Top Back & Actions Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-amber-400 hover:underline flex items-center gap-1.5 font-bold">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Inquiries</span>
        </a>

        <div class="flex items-center gap-3">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}?text=Hello%20{{ urlencode($inquiry->name) }},%20this%20is%20Eng.%20Sanjaya%20from%20Kandy%20Iron%20Works%20regarding%20your%20inquiry%20for%20{{ urlencode($inquiry->service_type) }}." target="_blank"
               class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-all flex items-center gap-1.5">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>Open WhatsApp Chat</span>
            </a>

            <a href="tel:{{ $inquiry->phone }}"
               class="px-3.5 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-white text-xs font-bold transition-all border border-white/10 flex items-center gap-1.5">
                <i class="fa-solid fa-phone text-amber-400"></i>
                <span>Call Client</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Customer & Project Details (7 cols) -->
        <div class="lg:col-span-7 glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 space-y-6 shadow-xl">
            <div class="flex items-center justify-between pb-4 border-b border-white/10">
                <div>
                    <h3 class="text-xl font-bold text-white">{{ $inquiry->name }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Submitted on {{ $inquiry->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $inquiry->status_badge_class }}">
                    {{ $inquiry->formatted_status }}
                </span>
            </div>

            <!-- Details List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="bg-black/30 p-3.5 rounded-xl border border-white/5">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block mb-1">Phone Number</span>
                    <a href="tel:{{ $inquiry->phone }}" class="text-sm font-bold text-amber-400 hover:underline">{{ $inquiry->phone }}</a>
                </div>

                <div class="bg-black/30 p-3.5 rounded-xl border border-white/5">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block mb-1">Email</span>
                    <span class="text-sm text-slate-200">{{ $inquiry->email ?? 'Not provided' }}</span>
                </div>

                <div class="bg-black/30 p-3.5 rounded-xl border border-white/5">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block mb-1">Location</span>
                    <span class="text-sm text-slate-200">{{ $inquiry->location ?? 'Central Province' }}</span>
                </div>

                <div class="bg-black/30 p-3.5 rounded-xl border border-white/5">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block mb-1">Service Requested</span>
                    <span class="text-sm font-bold text-white">{{ $inquiry->service_type }}</span>
                </div>

                <div class="bg-black/30 p-3.5 rounded-xl border border-white/5">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block mb-1">Approx Dimensions</span>
                    <span class="text-sm text-slate-200">{{ $inquiry->dimensions ?? 'Needs on-site laser measurement' }}</span>
                </div>

                <div class="bg-black/30 p-3.5 rounded-xl border border-white/5">
                    <span class="text-slate-400 text-[10px] uppercase font-bold block mb-1">Estimated Budget</span>
                    <span class="text-sm font-bold text-amber-400">{{ $inquiry->estimated_budget ?? 'Pending Site Quote' }}</span>
                </div>
            </div>

            <!-- Customer Message -->
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Customer Message / Notes</span>
                <div class="bg-black/40 p-4 rounded-xl border border-white/5 text-xs text-slate-300 leading-relaxed italic">
                    {{ $inquiry->message ?? 'No additional notes provided by client.' }}
                </div>
            </div>
        </div>

        <!-- Right: Status Modifier & Internal Workshop Notes (5 cols) -->
        <div class="lg:col-span-5 glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 space-y-6 shadow-xl">
            <h4 class="font-bold text-sm text-white flex items-center gap-2">
                <i class="fa-solid fa-sliders text-amber-400"></i>
                <span>Update Status &amp; Notes</span>
            </h4>

            <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Workflow Status</label>
                    <select name="status" class="w-full bg-[#111827] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                        <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>Pending Review</option>
                        <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Contacted Client</option>
                        <option value="site_visit" {{ $inquiry->status === 'site_visit' ? 'selected' : '' }}>Site Visit Scheduled</option>
                        <option value="quoted" {{ $inquiry->status === 'quoted' ? 'selected' : '' }}>Quote Sent to Client</option>
                        <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Project Completed</option>
                        <option value="cancelled" {{ $inquiry->status === 'cancelled' ? 'selected' : '' }}>Cancelled / Closed</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Confirmed Quotation Value</label>
                    <input type="text" name="estimated_budget" value="{{ $inquiry->estimated_budget }}" placeholder="e.g. LKR 420,000" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Internal Workshop Notes</label>
                    <textarea name="internal_notes" rows="4" placeholder="Log site visit date, motor model specs, advance payment received, or drawing numbers..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">{{ $inquiry->internal_notes }}</textarea>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl font-bold text-xs uppercase tracking-wider bg-amber-500 hover:bg-amber-400 text-black shadow-glow transition-all">
                    Save Updates
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
