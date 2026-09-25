<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'location',
        'service_type',
        'dimensions',
        'material_preference',
        'estimated_budget',
        'message',
        'status',
        'internal_notes',
        'source',
    ];

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-500/20 text-amber-400 border border-amber-500/30',
            'contacted' => 'bg-blue-500/20 text-blue-400 border border-blue-500/30',
            'site_visit' => 'bg-purple-500/20 text-purple-400 border border-purple-500/30',
            'quoted' => 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30',
            'completed' => 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30',
            'cancelled' => 'bg-rose-500/20 text-rose-400 border border-rose-500/30',
            default => 'bg-gray-500/20 text-gray-400 border border-gray-500/30',
        };
    }

    public function getFormattedStatusAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Pending Review',
            'contacted' => 'Contacted Client',
            'site_visit' => 'Site Visit Scheduled',
            'quoted' => 'Quote Sent',
            'completed' => 'Project Completed',
            'cancelled' => 'Cancelled / Closed',
            default => ucfirst($this->status),
        };
    }
}
