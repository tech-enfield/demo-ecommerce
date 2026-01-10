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
        // For the actual product which name would be like Acer Predator Triton Neo 16
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Schema::create('colors', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');        // Silver, Black
        //     $table->string('slug');
        //     $table->string('hex')->nullable(); // #C0C0C0
        //     $table->timestamps();
        // });

        // Schema::create('product_colors', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('color_id')->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        // });

        // Product relation to it's multiple images
        // Schema::create('product_images', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('color_id')->nullable()->constrained()->nullOnDelete();
        //     $table->string('path');
        //     $table->string('alt')->nullable();
        //     $table->integer('sort_order')->default(0);
        //     $table->boolean('is_primary')->default(false);
        //     $table->timestamps();
        // });

        // For the group like body, dimension, graphics, etc
        // Schema::create('attribute_groups', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('slug')->unique();
        //     $table->timestamps();
        // });

        // For the actual attributes like RAM,, processor,
        // Schema::create('attributes', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('attribute_group_id')->constrained()->cascadeOnDelete();
        //     $table->string('name');
        //     $table->string('slug')->unique();
        //     $table->timestamps();
        // });

        // For attribute's value like RAM 8GB, 16GB, etc
        // Schema::create('attribute_values', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('attribute_id')->constrained('attributes', 'id')->cascadeOnDelete();
        //     $table->string('value');
        //     $table->string('slug')->nullable();
        //     $table->timestamps();
        //     $table->unique(['attribute_id', 'slug']);
        // });

        // Product to category relation
        // Schema::create('category_products', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        //     $table->unique(['category_id', 'product_id']);
        // });

        // Product relations to it's multiple variants like Acer Predator Triton Neo 16 PTN16-51-96GK OR Acer Predator Triton Neo 16 PTN16-51-932N
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->string('alt')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        // Product Varaint relation to it's multiple images
        // Schema::create('product_variant_images', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
        //     $table->string('path');
        //     $table->string('alt')->nullable();
        //     $table->integer('sort_order')->default(0);
        //     $table->boolean('is_primary')->default(false);
        //     $table->timestamps();
        // });

        // To assign attributes to the product variant wise
        // Schema::create('product_variant_attributes', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('attribute_value_id')->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        // });

        // Schema::create('product_variant_colors', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('color_id')->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('product_variant_attributes');
        // Schema::dropIfExists('product_variant_images');
        Schema::dropIfExists('images');
        Schema::dropIfExists('product_variants');
        // Schema::dropIfExists('category_products');
        // Schema::dropIfExists('attribute_values');
        // Schema::dropIfExists('attributes');
        // Schema::dropIfExists('attribute_groups');
        // Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
