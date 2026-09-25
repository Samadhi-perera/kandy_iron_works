<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'location',
        'client_name',
        'completed_year',
        'image_url',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'gates' => 'Wrought Iron & Modern Gates',
            'railings' => 'Staircases & Balustrades',
            'roofing' => 'Steel Roofing & Canopies',
            'structural' => 'Structural & Warehouse Steel',
            'laser_cut' => 'CNC Laser Cut Panels',
            'custom' => 'Custom Metal Craft & Furniture',
            default => ucfirst($this->category),
        };
    }
}
