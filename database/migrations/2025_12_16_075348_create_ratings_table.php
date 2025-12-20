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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained();
            $table->decimal('rating');
            $table->integer('count');
            $table->timestamps();
        });

        Schema::create('rated_by', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->decimal('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rated_by');
        Schema::dropIfExists('ratings');
    }
};
