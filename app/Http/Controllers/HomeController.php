<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        if ($featuredProjects->isEmpty()) {
            $featuredProjects = Project::orderBy('sort_order')->take(6)->get();
        }

        $catalogItems = CatalogItem::where('is_active', true)
            ->orderBy('id')
            ->take(8)
            ->get();

        $testimonials = Testimonial::where('is_featured', true)->get();
        $settings = Setting::pluck('value', 'key');

        return view('home', compact('featuredProjects', 'catalogItems', 'testimonials', 'settings'));
    }

    public function portfolio(Request $request)
    {
        $category = $request->query('category');
        $query = Project::query();

        if ($category && in_array($category, ['gates', 'railings', 'roofing', 'structural', 'laser_cut', 'custom'])) {
            $query->where('category', $category);
        }

        $projects = $query->orderBy('sort_order')->paginate(12);
        $settings = Setting::pluck('value', 'key');

        return view('portfolio', compact('projects', 'category', 'settings'));
    }

    public function catalog(Request $request)
    {
        $category = $request->query('category');
        $query = CatalogItem::where('is_active', true);

        if ($category && in_array($category, ['gates', 'railings', 'roofing', 'grills', 'furniture'])) {
            $query->where('category', $category);
        }

        $items = $query->orderBy('id')->paginate(12);
        $settings = Setting::pluck('value', 'key');

        return view('catalog', compact('items', 'category', 'settings'));
    }

    public function calculator()
    {
        $settings = Setting::pluck('value', 'key');
        return view('calculator', compact('settings'));
    }

    public function contact()
    {
        $settings = Setting::pluck('value', 'key');
        return view('contact', compact('settings'));
    }

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'service_type' => 'required|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'material_preference' => 'nullable|string|max:255',
            'estimated_budget' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:2000',
            'source' => 'nullable|string|max:50',
        ]);

        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'location' => $validated['location'] ?? 'Kandy / Central Province',
            'service_type' => $validated['service_type'],
            'dimensions' => $validated['dimensions'] ?? null,
            'material_preference' => $validated['material_preference'] ?? null,
            'estimated_budget' => $validated['estimated_budget'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
            'source' => $validated['source'] ?? 'website',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your quote request has been received. Our fabrication master will contact you within 2-4 hours to discuss or schedule a free site inspection.',
                'inquiry_id' => $inquiry->id,
            ]);
        }

        return back()->with('success', 'Thank you! Your quote request has been received. Our fabrication master will contact you within 2-4 hours to discuss or schedule a free site inspection.');
    }
}
