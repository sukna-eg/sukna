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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->text('address');
			$table->text('description');
            $table->boolean('type');
            $table->boolean('show')->default(0);
            $table->double('space');
            $table->integer('bedrooms_count')->nullable();
            $table->integer('bathrooms_count')->nullable();
            $table->string('cladding')->nullable();
			$table->string('floor')->nullable();
            $table->boolean('furnished')->default(0);
            $table->double('lat')->nullable();
            $table->double('long')->nullable();
            $table->boolean('elevator')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('order')->default(0);
            $table->boolean('premium')->default(0);
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->integer('period')->nullable();
            $table->integer('views')->default(0);
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('video_url')->nullable();
            $table->string('music_url')->nullable();
            $table->string('direction');
            $table->string('Property');
            $table->string('purpose');
            $table->double('price');
            $table->integer('subcategory_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
