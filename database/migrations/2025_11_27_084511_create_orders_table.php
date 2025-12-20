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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Who placed the order
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Order identifiers
            $table->string('order_number')->unique();

            // Receiver info
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('receiver_email')->nullable();

            // Shipping address (foreign keys)
            $table->foreignId('shipping_province_id')->constrained('provinces');
            $table->foreignId('shipping_district_id')->constrained('districts');
            $table->foreignId('shipping_municipality_id')->nullable()->constrained('municipalities');
            $table->string('shipping_area')->nullable();  // Optional: neighborhood/ward
            $table->string('shipping_street')->nullable();
            $table->string('shipping_notes')->nullable();

            // Billing address (optional)
            $table->foreignId('billing_province_id')->nullable()->constrained('provinces');
            $table->foreignId('billing_district_id')->nullable()->constrained('districts');
            $table->foreignId('billing_municipality_id')->nullable()->constrained('municipalities');
            $table->string('billing_area')->nullable();
            $table->string('billing_street')->nullable();

            // Payment
            $table->enum('payment_method', ['cod', 'esewa', 'khalti', 'bank']);
            $table->enum('payment_status', ['unpaid', 'paid', 'partial', 'refunded'])->default('unpaid');
            $table->string('transaction_id')->nullable();

            // Totals
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2);

            // Order status
            $table->enum('status', [
                'pending',
                'processing',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Link to order
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            // Product variant
            $table->foreignId('product_variant_id')->constrained()->onDelete('cascade');
            $table->string('product_variant_title');
            $table->string('sku')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2); // unit_price × quantity

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
