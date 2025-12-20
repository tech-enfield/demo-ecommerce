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
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['slug', 'meta_title', 'is_active']);
        });

        Schema::create('category_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('parent_category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->unique(['category_id', 'parent_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_relations');
        Schema::dropIfExists('categories');
    }
};
