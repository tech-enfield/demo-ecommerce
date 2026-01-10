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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });

         Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        // Schema::create('category_relations', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->foreignId('parent_category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->timestamps();
        //     $table->unique(['category_id', 'parent_category_id']);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('category_relations');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
    }
};
