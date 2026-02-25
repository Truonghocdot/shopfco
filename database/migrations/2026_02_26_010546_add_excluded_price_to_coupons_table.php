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
        Schema::table('coupons', function (Blueprint $table) {
            $table->decimal('excluded_min_price', 15, 2)->nullable()->after('status')->comment('Giá tối thiểu sản phẩm bị loại trừ');
            $table->decimal('excluded_max_price', 15, 2)->nullable()->after('excluded_min_price')->comment('Giá tối đa sản phẩm bị loại trừ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn(['excluded_min_price', 'excluded_max_price']);
        });
    }
};
