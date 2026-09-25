<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:gates,railings,roofing,structural,laser_cut,custom',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'completed_year' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $imageUrl = $validated['image_url'] ?? '/images/showcase/luxury_gate.jpg';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/projects'), $filename);
            $imageUrl = '/uploads/projects/' . $filename;
        }

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?? 'Kandy, Sri Lanka',
            'client_name' => $validated['client_name'] ?? null,
            'completed_year' => $validated['completed_year'] ?? date('Y'),
            'image_url' => $imageUrl,
            'is_featured' => $request->has('is_featured'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project added successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:gates,railings,roofing,structural,laser_cut,custom',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'completed_year' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $imageUrl = $project->image_url;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/projects'), $filename);
            $imageUrl = '/uploads/projects/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imageUrl = $validated['image_url'];
        }

        $project->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'client_name' => $validated['client_name'],
            'completed_year' => $validated['completed_year'],
            'image_url' => $imageUrl,
            'is_featured' => $request->has('is_featured'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project removed.');
    }
}
