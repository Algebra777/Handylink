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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer')->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar_path')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('avatar_path');
            $table->boolean('is_verified')->default(false)->after('bio');
            $table->string('city')->nullable()->after('is_verified');
            $table->string('state')->nullable()->after('city');
            $table->string('country')->nullable()->after('state');
            $table->string('address')->nullable()->after('country');
            $table->string('timezone')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'phone',
                'avatar_path',
                'bio',
                'is_verified',
                'city',
                'state',
                'country',
                'address',
                'timezone',
            ]);
        });
    }
};
