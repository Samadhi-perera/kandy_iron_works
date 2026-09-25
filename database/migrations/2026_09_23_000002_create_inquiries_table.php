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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('service_type');
            $table->string('dimensions')->nullable();
            $table->string('material_preference')->nullable();
            $table->string('estimated_budget')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('pending'); // pending, contacted, site_visit, quoted, completed, cancelled
            $table->text('internal_notes')->nullable();
            $table->string('source')->default('website'); // website, estimator, direct
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
