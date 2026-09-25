@extends('layouts.admin')

@section('title', 'Portfolio Projects')
@section('header_title', 'Portfolio & Showcase Manager')
@section('header_subtitle', 'Manage projects displayed on the public website showcase')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-xs text-slate-400">Total Projects: <strong class="text-white">{{ $projects->total() }}</strong></p>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold transition-all shadow-glow flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Project</span>
        </a>
    </div>

    <div class="glass-panel rounded-2xl border border-white/10 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-white/5 uppercase text-slate-400 border-b border-white/5 text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Photo</th>
                        <th class="py-3.5 px-4">Project Title</th>
                        <th class="py-3.5 px-4">Category</th>
                        <th class="py-3.5 px-4">Location</th>
                        <th class="py-3.5 px-4">Featured</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($projects as $project)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="py-3 px-4 w-20">
                                <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" class="w-14 h-14 rounded-xl object-cover border border-white/10">
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-white text-sm">{{ $project->title }}</div>
                                <div class="text-slate-400 text-[11px] line-clamp-1 mt-0.5">{{ $project->description }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-white/5 text-amber-400 border border-white/10">
                                    {{ $project->category_label }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-300">
                                {{ $project->location ?? 'Kandy' }}
                                <div class="text-[10px] text-slate-400">{{ $project->completed_year }}</div>
                            </td>
                            <td class="py-3 px-4">
                                @if($project->is_featured)
                                    <span class="text-amber-400 font-bold text-xs"><i class="fa-solid fa-star mr-1"></i> Featured</span>
                                @else
                                    <span class="text-slate-500 text-xs">Standard</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="p-2 rounded-lg bg-white/5 text-slate-300 hover:bg-amber-500 hover:text-black transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this project?');">
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
                            <td colspan="6" class="py-12 text-center text-slate-400">No projects added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/5">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
