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
            $table->enum('user_type', ['user', 'agent'])->default('user')->after('status');
            $table->string('national_id', 50)->nullable()->after('user_type');
            $table->string('kra_pin', 20)->nullable()->after('national_id');
            $table->boolean('terms_accepted')->default(false)->after('kra_pin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_type', 'national_id', 'kra_pin', 'terms_accepted']);
        });
    }
};
