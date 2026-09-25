<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCatalogController extends Controller
{
    public function index()
    {
        $items = CatalogItem::orderBy('id', 'desc')->paginate(15);
        return view('admin.catalog.index', compact('items'));
    }

    public function create()
    {
        return view('admin.catalog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:catalog_items,code|max:50',
            'title' => 'required|string|max:255',
            'category' => 'required|in:gates,railings,roofing,grills,furniture',
            'material' => 'required|string|max:255',
            'base_price_lkr' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $imageUrl = $validated['image_url'] ?? '/images/showcase/luxury_gate.jpg';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->code) . '.' . $file->getClientOriginalExtension();
            $destPublic = public_path('uploads/catalog');
            if (!is_dir($destPublic)) {
                @mkdir($destPublic, 0755, true);
            }
            $file->move($destPublic, $filename);

            $destBase = base_path('uploads/catalog');
            if (realpath($destBase) !== realpath($destPublic)) {
                if (!is_dir($destBase)) {
                    @mkdir($destBase, 0755, true);
                }
                @copy($destPublic . DIRECTORY_SEPARATOR . $filename, $destBase . DIRECTORY_SEPARATOR . $filename);
            }

            $imageUrl = '/uploads/catalog/' . $filename;
        }

        CatalogItem::create([
            'code' => strtoupper($validated['code']),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'material' => $validated['material'],
            'base_price_lkr' => $validated['base_price_lkr'] ?? 0,
            'price_unit' => $validated['price_unit'] ?? 'sq. ft',
            'image_url' => $imageUrl,
            'description' => $validated['description'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.catalog.index')->with('success', 'Catalog design item added!');
    }

    public function edit(CatalogItem $catalog)
    {
        return view('admin.catalog.edit', compact('catalog'));
    }

    public function update(Request $request, CatalogItem $catalog)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:catalog_items,code,' . $catalog->id,
            'title' => 'required|string|max:255',
            'category' => 'required|in:gates,railings,roofing,grills,furniture',
            'material' => 'required|string|max:255',
            'base_price_lkr' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $imageUrl = $catalog->image_url;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->code) . '.' . $file->getClientOriginalExtension();
            $destPublic = public_path('uploads/catalog');
            if (!is_dir($destPublic)) {
                @mkdir($destPublic, 0755, true);
            }
            $file->move($destPublic, $filename);

            $destBase = base_path('uploads/catalog');
            if (realpath($destBase) !== realpath($destPublic)) {
                if (!is_dir($destBase)) {
                    @mkdir($destBase, 0755, true);
                }
                @copy($destPublic . DIRECTORY_SEPARATOR . $filename, $destBase . DIRECTORY_SEPARATOR . $filename);
            }

            $imageUrl = '/uploads/catalog/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imageUrl = $validated['image_url'];
        }

        $catalog->update([
            'code' => strtoupper($validated['code']),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'material' => $validated['material'],
            'base_price_lkr' => $validated['base_price_lkr'] ?? 0,
            'price_unit' => $validated['price_unit'] ?? 'sq. ft',
            'image_url' => $imageUrl,
            'description' => $validated['description'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.catalog.index')->with('success', 'Catalog item updated!');
    }

    public function destroy(CatalogItem $catalog)
    {
        $catalog->delete();
        return redirect()->route('admin.catalog.index')->with('success', 'Catalog item removed.');
    }
}
