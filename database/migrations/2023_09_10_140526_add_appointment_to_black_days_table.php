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
        Schema::table('black_days', function (Blueprint $table) {

            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('black_days', function (Blueprint $table) {
            //
        });
    }
};
