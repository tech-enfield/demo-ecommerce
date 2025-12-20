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

            // Basic info
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('sku')->nullable()->unique(); // optional sku
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->timestamps();
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');        // Silver, Black
            $table->string('slug');
            $table->string('hex')->nullable(); // #C0C0C0
            $table->timestamps();
        });

        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // Product relation to it's multiple images
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->nullable()->constrained()->nullOnDelete();
            $table->string('path');
            $table->string('alt')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        // For the group like body, dimension, graphics, etc
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // For the actual attributes like RAM,, processor,
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_group_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // For attribute's value like RAM 8GB, 16GB, etc
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('attributes', 'id')->cascadeOnDelete();
            $table->string('value');
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->unique(['attribute_id', 'slug']);
        });

        // Product to category relation
        Schema::create('category_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['category_id', 'product_id']);
        });

        // Product relations to it's multiple variants like Acer Predator Triton Neo 16 PTN16-51-96GK OR Acer Predator Triton Neo 16 PTN16-51-932N
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->nullable()->unique();
            $table->string('slug')->nullable()->unique();
            $table->string('title')->nullable();
            $table->json('options')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // Pricing
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('sale_price', 12, 2)->nullable();
            $table->dateTime('sale_starts_at')->nullable();
            $table->dateTime('sale_ends_at')->nullable();
            $table->decimal('cost_price', 12, 2)->nullable(); // internal use

            // Inventory
            $table->boolean('manage_stock')->default(true);
            $table->integer('stock_quantity')->default(0);
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'on_backorder'])->default('out_of_stock');

            // Shipping / physical attributes
            $table->decimal('weight', 8, 3)->nullable(); // kg
            $table->decimal('length', 8, 2)->nullable(); // cm
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();

            // Flags / status
            $table->boolean('is_active')->default(true);
            $table->boolean('on_sale')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_best_selling')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['price']);
            $table->index(['is_active', 'is_featured']);
            $table->index(['published_at']);
        });

        // Product Varaint relation to it's multiple images
        Schema::create('product_variant_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('alt')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        // To assign attributes to the product variant wise
        Schema::create('product_variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_value_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('product_variant_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attributes');
        Schema::dropIfExists('product_variant_images');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('category_products');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_groups');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
