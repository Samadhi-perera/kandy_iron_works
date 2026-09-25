<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'category',
        'material',
        'base_price_lkr',
        'price_unit',
        'image_url',
        'description',
        'is_active',
    ];

    protected $casts = [
        'base_price_lkr' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'gates' => 'Gates',
            'railings' => 'Railings & Stairs',
            'roofing' => 'Roofing & Canopies',
            'grills' => 'Window Grills',
            'furniture' => 'Designer Furniture',
            default => ucfirst($this->category),
        };
    }
}
