@extends('layouts.admin')

@section('title', 'Add New Project')
@section('header_title', 'Create Portfolio Project')
@section('header_subtitle', 'Upload high-resolution photography and technical specs of recent steelwork')

@section('content')
<div class="max-w-4xl space-y-6">
    <a href="{{ route('admin.projects.index') }}" class="text-xs text-amber-400 hover:underline flex items-center gap-1.5 font-bold">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Projects</span>
    </a>

    <div class="glass-panel p-8 rounded-3xl border border-white/10 shadow-2xl">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Project Title <span class="text-amber-400">*</span></label>
                    <input type="text" name="title" required placeholder="e.g. Modern Laser-Cut Villa Gate" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Category <span class="text-amber-400">*</span></label>
                    <select name="category" required class="w-full bg-[#111827] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                        <option value="gates">Wrought Iron &amp; Modern Gates</option>
                        <option value="railings">Stairs &amp; Railings</option>
                        <option value="roofing">Roofing &amp; Canopies</option>
                        <option value="laser_cut">CNC Laser-Cut Panels</option>
                        <option value="structural">Structural &amp; Industrial Steel</option>
                        <option value="custom">Custom Metal Craft &amp; Furniture</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Location / City</label>
                    <input type="text" name="location" placeholder="e.g. Peradeniya, Kandy" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Client Name (Optional)</label>
                    <input type="text" name="client_name" placeholder="e.g. Amara Villa" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Completed Year</label>
                    <input type="text" name="completed_year" value="{{ date('Y') }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Project Description <span class="text-amber-400">*</span></label>
                <textarea name="description" rows="4" required placeholder="Describe materials, engineering highlights, finishing (hot-dip galvanized, powder coated), dimensions..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-black/30 p-5 rounded-2xl border border-white/5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Upload Project Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-black hover:file:bg-amber-400 cursor-pointer">
                    <p class="text-[10px] text-slate-400 mt-1">Accepts JPG, PNG, WebP up to 5MB.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Or Image URL / Curated Showcase</label>
                    <input type="text" name="image_url" placeholder="/images/showcase/luxury_gate.jpg" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                    <p class="text-[10px] text-slate-400 mt-1">Default will be assigned if left blank.</p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_featured" value="1" checked class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                    <span class="font-bold text-white">Feature on Homepage Showcase</span>
                </label>
            </div>

            <div class="pt-4 border-t border-white/10 flex justify-end gap-3">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-bold text-slate-300 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-extrabold uppercase tracking-wider shadow-glow transition-all">
                    Publish Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
