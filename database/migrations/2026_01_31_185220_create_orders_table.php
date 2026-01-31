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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null');

            // Order details
            $table->string('order_number')->unique();
            $table->decimal('product_price', 15, 2); // Giá gốc sản phẩm
            $table->decimal('discount_amount', 15, 2)->default(0); // Số tiền giảm
            $table->decimal('final_amount', 15, 2); // Số tiền cuối cùng phải trả

            // Status: 0 = pending, 1 = completed, 2 = cancelled, 3 = refunded
            $table->tinyInteger('status')->default(0)->comment('0:pending | 1:completed | 2:cancelled | 3:refunded');

            // Payment info
            $table->decimal('wallet_balance_before', 15, 2)->nullable(); // Số dư trước khi mua
            $table->decimal('wallet_balance_after', 15, 2)->nullable(); // Số dư sau khi mua

            // Additional info
            $table->text('notes')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('product_id');
            $table->index('order_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
