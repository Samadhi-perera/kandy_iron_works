@extends('layouts.admin')

@section('title', 'Workshop Settings')
@section('header_title', 'Workshop Profile & Contact Settings')
@section('header_subtitle', 'Configure phone numbers, WhatsApp, physical address, and hours shown on the website')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="glass-panel p-8 rounded-3xl border border-white/10 shadow-2xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Workshop Business Name</label>
                    <input type="text" name="workshop_name" value="{{ $settings['workshop_name'] ?? 'Kandy Iron Works' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Marketing Tagline</label>
                    <input type="text" name="tagline" value="{{ $settings['tagline'] ?? 'Master Steel & Architectural Iron Craftsmanship Since 2008' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Primary Phone (Landline)</label>
                    <input type="text" name="phone_primary" value="{{ $settings['phone_primary'] ?? '+94 81 223 4567' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Fabricator Mobile / Direct</label>
                    <input type="text" name="phone_mobile" value="{{ $settings['phone_mobile'] ?? '+94 77 123 4567' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">WhatsApp Number (e.g. 94771234567)</label>
                    <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '94771234567' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Workshop Email Address</label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? 'info@kandyironworks.com' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Operating Hours</label>
                    <input type="text" name="working_hours" value="{{ $settings['working_hours'] ?? 'Mon – Sat: 8:00 AM – 6:30 PM (Sun: By Appointment)' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Workshop Physical Address</label>
                <input type="text" name="address" value="{{ $settings['address'] ?? 'No. 142, William Gopallawa Mawatha, Kandy, Sri Lanka' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Years in Business Badge</label>
                    <input type="text" name="experience_years" value="{{ $settings['experience_years'] ?? '16+' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Completed Projects Badge</label>
                    <input type="text" name="projects_completed" value="{{ $settings['projects_completed'] ?? '1,450+' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Warranty Claim Badge</label>
                    <input type="text" name="warranty_years" value="{{ $settings['warranty_years'] ?? '10-Year Rust Guarantee' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">About Company / Workshop Bio</label>
                <textarea name="about_snippet" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">{{ $settings['about_snippet'] ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Home Page Background Video URL (Optional)</label>
                <input type="text" name="hero_video_url" value="{{ $settings['hero_video_url'] ?? '' }}" placeholder="Leave blank to use default public/videos/hero_forge.webm or enter custom MP4/WebM URL" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                <p class="text-[10px] text-slate-400 mt-1">Default video is <code class="text-amber-400">public/videos/hero_forge.webm</code>. You can also place any MP4 named <code class="text-amber-400">hero_forge.mp4</code> into <code class="text-amber-400">public/videos/</code>.</p>
            </div>

            <div class="pt-4 border-t border-white/10 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-extrabold uppercase tracking-wider shadow-glow transition-all">
                    Save Workshop Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
