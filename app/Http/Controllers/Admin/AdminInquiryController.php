<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Inquiry::query();

        if ($status && in_array($status, ['pending', 'contacted', 'site_visit', 'quoted', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('service_type', 'like', "%{$search}%");
            });
        }

        $inquiries = $query->latest()->paginate(15);
        $counts = [
            'all' => Inquiry::count(),
            'pending' => Inquiry::where('status', 'pending')->count(),
            'contacted' => Inquiry::where('status', 'contacted')->count(),
            'site_visit' => Inquiry::where('status', 'site_visit')->count(),
            'quoted' => Inquiry::where('status', 'quoted')->count(),
            'completed' => Inquiry::where('status', 'completed')->count(),
        ];

        return view('admin.inquiries.index', compact('inquiries', 'status', 'search', 'counts'));
    }

    public function show(Inquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,site_visit,quoted,completed,cancelled',
            'internal_notes' => 'nullable|string',
            'estimated_budget' => 'nullable|string',
        ]);

        $inquiry->update($validated);

        return back()->with('success', "Inquiry status updated to '" . $inquiry->formatted_status . "'.");
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
