@extends('layouts.admin')

@section('title', 'Add Catalog Design')
@section('header_title', 'Create Catalog Pattern')
@section('header_subtitle', 'Register a new standard metalwork pattern with design code and rate')

@section('content')
<div class="max-w-4xl space-y-6">
    <a href="{{ route('admin.catalog.index') }}" class="text-xs text-amber-400 hover:underline flex items-center gap-1.5 font-bold">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Catalog</span>
    </a>

    <div class="glass-panel p-8 rounded-3xl border border-white/10 shadow-2xl">
        <form action="{{ route('admin.catalog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Design Code <span class="text-amber-400">*</span></label>
                    <input type="text" name="code" required placeholder="e.g. KIW-GT-103" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 uppercase font-mono focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Design Title <span class="text-amber-400">*</span></label>
                    <input type="text" name="title" required placeholder="e.g. Geometric CNC Pivot Gate" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Category <span class="text-amber-400">*</span></label>
                    <select name="category" required class="w-full bg-[#111827] border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                        <option value="gates">Driveway &amp; Main Gates</option>
                        <option value="railings">Stairs &amp; Balustrades</option>
                        <option value="roofing">Roofing &amp; Canopies</option>
                        <option value="grills">Window Security Grills</option>
                        <option value="furniture">Custom Metal Furniture</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Base Material Specification <span class="text-amber-400">*</span></label>
                    <input type="text" name="material" required placeholder="e.g. Hot-Dip Galvanized + 3mm CNC Steel" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Base Price (LKR)</label>
                    <div class="flex gap-2">
                        <input type="number" step="10" name="base_price_lkr" placeholder="4200" class="w-2/3 bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-amber-400">
                        <input type="text" name="price_unit" value="sq. ft" placeholder="sq. ft" class="w-1/3 bg-white/5 border border-white/10 rounded-xl px-2 py-2.5 text-xs text-white text-center focus:outline-none focus:border-amber-400">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Technical Description</label>
                <textarea name="description" rows="3" placeholder="Specify frame dimensions, roller bearings, standard paint primer, optional automation compatibility..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-amber-400"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-black/30 p-5 rounded-2xl border border-white/5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Upload Pattern Photo</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-black hover:file:bg-amber-400 cursor-pointer">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Or Image URL</label>
                    <input type="text" name="image_url" placeholder="/images/showcase/luxury_gate.jpg" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                    <span class="font-bold text-white">Active in Public Catalog</span>
                </label>
            </div>

            <div class="pt-4 border-t border-white/10 flex justify-end gap-3">
                <a href="{{ route('admin.catalog.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-bold text-slate-300 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-extrabold uppercase tracking-wider shadow-glow transition-all">
                    Save Design Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
