<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogItem;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Testimonial;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_inquiries' => Inquiry::count(),
            'pending_inquiries' => Inquiry::where('status', 'pending')->count(),
            'site_visits' => Inquiry::where('status', 'site_visit')->count(),
            'active_quotes' => Inquiry::where('status', 'quoted')->count(),
            'completed_jobs' => Inquiry::where('status', 'completed')->count(),
            'total_projects' => Project::count(),
            'catalog_items' => CatalogItem::count(),
            'testimonials' => Testimonial::count(),
        ];

        $recentInquiries = Inquiry::latest()->take(6)->get();
        $recentProjects = Project::latest()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'recentProjects'));
    }
}
