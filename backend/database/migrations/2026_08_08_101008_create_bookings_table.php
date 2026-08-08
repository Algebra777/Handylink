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
        if (!Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('artisan_id')->constrained('users')->cascadeOnDelete();
                $table->string('service_name');
                $table->string('service_category')->nullable();
                $table->decimal('price', 10, 2)->default(0);
                $table->date('scheduled_date');
                $table->string('scheduled_time')->nullable();
                $table->string('location')->nullable();
                $table->text('notes')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
