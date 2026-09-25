@extends('layouts.admin')

@section('title', 'Edit Project: ' . $project->title)
@section('header_title', 'Edit Project')
@section('header_subtitle', 'Update project media, title, or categorization')

@section('content')
<div class="max-w-4xl space-y-6">
    <a href="{{ route('admin.projects.index') }}" class="text-xs text-amber-400 hover:underline flex items-center gap-1.5 font-bold">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Projects</span>
    </a>

    <div class="glass-panel p-8 rounded-3xl border border-white/10 shadow-2xl">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Project Title <span class="text-amber-400">*</span></label>
                    <input type="text" name="title" value="{{ $project->title }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Category <span class="text-amber-400">*</span></label>
                    <select name="category" required class="w-full bg-[#111827] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                        <option value="gates" {{ $project->category === 'gates' ? 'selected' : '' }}>Wrought Iron &amp; Modern Gates</option>
                        <option value="railings" {{ $project->category === 'railings' ? 'selected' : '' }}>Stairs &amp; Railings</option>
                        <option value="roofing" {{ $project->category === 'roofing' ? 'selected' : '' }}>Roofing &amp; Canopies</option>
                        <option value="laser_cut" {{ $project->category === 'laser_cut' ? 'selected' : '' }}>CNC Laser-Cut Panels</option>
                        <option value="structural" {{ $project->category === 'structural' ? 'selected' : '' }}>Structural &amp; Industrial Steel</option>
                        <option value="custom" {{ $project->category === 'custom' ? 'selected' : '' }}>Custom Metal Craft &amp; Furniture</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Location / City</label>
                    <input type="text" name="location" value="{{ $project->location }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Client Name</label>
                    <input type="text" name="client_name" value="{{ $project->client_name }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Completed Year</label>
                    <input type="text" name="completed_year" value="{{ $project->completed_year }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Project Description <span class="text-amber-400">*</span></label>
                <textarea name="description" rows="4" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">{{ $project->description }}</textarea>
            </div>

            <div class="flex items-center gap-6 bg-black/30 p-5 rounded-2xl border border-white/5">
                <img src="{{ asset($project->image_url) }}" alt="Current Project Photo" class="w-20 h-20 rounded-xl object-cover border border-white/10">

                <div class="flex-1 space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Replace Image File</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-black hover:file:bg-amber-400 cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Or Direct Image URL</label>
                        <input type="text" name="image_url" value="{{ $project->image_url }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-amber-400">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }} class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                    <span class="font-bold text-white">Feature on Homepage Showcase</span>
                </label>
            </div>

            <div class="pt-4 border-t border-white/10 flex justify-end gap-3">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-bold text-slate-300 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-extrabold uppercase tracking-wider shadow-glow transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
