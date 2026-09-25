<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'is_featured' => 'nullable|boolean',
        ]);

        Testimonial::create([
            'client_name' => $validated['client_name'],
            'client_role' => $validated['client_role'],
            'location' => $validated['location'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $testimonial->update([
            'client_name' => $validated['client_name'],
            'client_role' => $validated['client_role'],
            'location' => $validated['location'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
