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
        Schema::table('artisans', function (Blueprint $table) {
            if (!Schema::hasColumn('artisans', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            }
            if (!Schema::hasColumn('artisans', 'business_name')) {
                $table->string('business_name')->nullable();
            }
            if (!Schema::hasColumn('artisans', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('artisans', 'hourly_rate')) {
                $table->decimal('hourly_rate', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('artisans', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('artisans', 'state')) {
                $table->string('state')->nullable();
            }
            if (!Schema::hasColumn('artisans', 'country')) {
                $table->string('country')->nullable();
            }
            if (!Schema::hasColumn('artisans', 'service_area')) {
                $table->string('service_area')->nullable();
            }
            if (!Schema::hasColumn('artisans', 'is_verified')) {
                $table->boolean('is_verified')->default(false);
            }
            if (!Schema::hasColumn('artisans', 'is_available')) {
                $table->boolean('is_available')->default(true);
            }
            if (!Schema::hasColumn('artisans', 'rating')) {
                $table->integer('rating')->default(0);
            }
            if (!Schema::hasColumn('artisans', 'review_count')) {
                $table->integer('review_count')->default(0);
            }
            if (!Schema::hasColumn('artisans', 'cover_image_path')) {
                $table->string('cover_image_path')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artisans', function (Blueprint $table) {
            //
        });
    }
};
