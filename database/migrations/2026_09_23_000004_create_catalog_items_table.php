<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. KIW-GT-101
            $table->string('title');
            $table->string('category'); // gates, railings, roofing, grills, furniture
            $table->string('material'); // Wrought Iron, Mild Steel, Stainless Steel, Galvanized
            $table->decimal('base_price_lkr', 12, 2)->nullable();
            $table->string('price_unit')->default('sq. ft');
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_items');
    }
};
