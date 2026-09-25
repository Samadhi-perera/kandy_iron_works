@extends('layouts.admin')

@section('title', 'Customer Reviews')
@section('header_title', 'Client Testimonials & Feedback')
@section('header_subtitle', 'Manage customer ratings displayed on the homepage')

@section('content')
<div class="space-y-8" x-data="{ 
    addModal: false, 
    editModal: false, 
    editItem: { id: '', client_name: '', client_role: '', location: '', rating: 5, comment: '', is_featured: false, update_url: '' } 
}">
    <div class="flex items-center justify-between">
        <p class="text-xs text-slate-400">Total Reviews: <strong class="text-white">{{ $testimonials->total() }}</strong></p>
        <button @click="addModal = true" class="px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold transition-all shadow-glow flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Add Testimonial</span>
        </button>
    </div>

    <!-- Reviews Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($testimonials as $t)
            <div class="glass-panel p-6 rounded-2xl border border-white/10 flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1 text-amber-400 text-xs">
                            @for($i = 0; $i < $t->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <div class="flex items-center gap-2">
                            @if($t->is_featured)
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30">Homepage</span>
                            @endif
                            <span class="text-[10px] text-slate-400">{{ $t->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <p class="text-xs text-slate-300 leading-relaxed italic">
                        "{{ $t->comment }}"
                    </p>
                </div>

                <div class="pt-4 border-t border-white/5 flex items-center justify-between">
                    <div>
                        <h5 class="text-xs font-bold text-white">{{ $t->client_name }}</h5>
                        <div class="text-[10px] text-amber-400">{{ $t->client_role ?? 'Client' }} &bull; {{ $t->location }}</div>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <button type="button" 
                                @click="editItem = { 
                                    id: {{ $t->id }}, 
                                    client_name: {{ json_encode($t->client_name) }}, 
                                    client_role: {{ json_encode($t->client_role ?? '') }}, 
                                    location: {{ json_encode($t->location ?? '') }}, 
                                    rating: {{ $t->rating }}, 
                                    comment: {{ json_encode($t->comment) }}, 
                                    is_featured: {{ $t->is_featured ? 'true' : 'false' }}, 
                                    update_url: '{{ route('admin.testimonials.update', $t->id) }}' 
                                }; editModal = true;"
                                class="p-2 rounded-lg bg-white/5 text-slate-400 hover:bg-amber-500 hover:text-black transition-colors" 
                                title="Edit Testimonial">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </button>
                        <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Delete this review?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-white/5 text-slate-400 hover:bg-rose-500 hover:text-white transition-colors" title="Delete">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 text-slate-400">No testimonials published.</div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $testimonials->links() }}
    </div>

    <!-- Add Modal -->
    <div x-show="addModal" x-transition.opacity.duration.200ms
         class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/20 max-w-lg w-full space-y-5" @click.away="addModal = false">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h4 class="font-bold text-base text-white">Add Customer Testimonial</h4>
                <button @click="addModal = false" class="text-slate-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Customer / Architect Name <span class="text-amber-400">*</span></label>
                    <input type="text" name="client_name" required placeholder="e.g. Dr. Priyantha Dissanayake" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Role / Designation</label>
                        <input type="text" name="client_role" placeholder="e.g. Homeowner / Architect" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Location in Sri Lanka</label>
                        <input type="text" name="location" placeholder="e.g. Kundasale / Kandy" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Star Rating</label>
                    <select name="rating" class="w-full bg-[#111827] border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                        <option value="5">5 Stars - Outstanding</option>
                        <option value="4">4 Stars - Very Good</option>
                        <option value="3">3 Stars - Good</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Review Comment <span class="text-amber-400">*</span></label>
                    <textarea name="comment" rows="3" required placeholder="Paste review text here..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400"></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_featured" value="1" checked class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                    <label class="text-xs text-slate-300">Feature on homepage</label>
                </div>

                <div class="pt-3 border-t border-white/10 flex justify-end gap-3">
                    <button type="button" @click="addModal = false" class="px-4 py-2 rounded-xl bg-white/5 text-xs text-slate-300">Cancel</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-amber-500 text-black font-bold text-xs uppercase tracking-wider">Save Review</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="editModal" x-transition.opacity.duration.200ms
         class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-white/20 max-w-lg w-full space-y-5" @click.away="editModal = false">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h4 class="font-bold text-base text-white">Edit Customer Testimonial</h4>
                <button @click="editModal = false" class="text-slate-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form :action="editItem.update_url" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Customer / Architect Name <span class="text-amber-400">*</span></label>
                    <input type="text" name="client_name" x-model="editItem.client_name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Role / Designation</label>
                        <input type="text" name="client_role" x-model="editItem.client_role" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Location in Sri Lanka</label>
                        <input type="text" name="location" x-model="editItem.location" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Star Rating</label>
                    <select name="rating" x-model="editItem.rating" class="w-full bg-[#111827] border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400">
                        <option value="5">5 Stars - Outstanding</option>
                        <option value="4">4 Stars - Very Good</option>
                        <option value="3">3 Stars - Good</option>
                        <option value="2">2 Stars - Fair</option>
                        <option value="1">1 Star - Poor</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Review Comment <span class="text-amber-400">*</span></label>
                    <textarea name="comment" rows="3" x-model="editItem.comment" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-amber-400"></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_featured" value="1" :checked="editItem.is_featured" class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                    <label class="text-xs text-slate-300">Feature on homepage showcase</label>
                </div>

                <div class="pt-3 border-t border-white/10 flex justify-end gap-3">
                    <button type="button" @click="editModal = false" class="px-4 py-2 rounded-xl bg-white/5 text-xs text-slate-300">Cancel</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-amber-500 text-black font-bold text-xs uppercase tracking-wider">Update Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
