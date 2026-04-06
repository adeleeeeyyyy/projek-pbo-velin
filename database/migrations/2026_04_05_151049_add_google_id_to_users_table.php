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
            // Social Login
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->unique()->after('email');
            }
            if (!Schema::hasColumn('users', 'provider')) {
                $table->string('provider')->nullable()->after('google_id');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('provider');
            }
            
            // Metadata needed by Controller
            if (!Schema::hasColumn('users', 'role_name')) {
                $table->string('role_name')->nullable()->after('avatar');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->nullable()->after('role_name');
            }
            if (!Schema::hasColumn('users', 'join_date')) {
                $table->string('join_date')->nullable()->after('status');
            }
            if (!Schema::hasColumn('users', 'last_login')) {
                $table->string('last_login')->nullable()->after('join_date');
            }

            // Other missing columns from the original file but not in DB
            if (!Schema::hasColumn('users', 'user_id')) {
                $table->string('user_id')->nullable()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'provider',
                'avatar',
                'role_name',
                'status',
                'join_date',
                'last_login',
                'user_id'
            ]);
        });
    }
};
