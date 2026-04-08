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
        Schema::create('free_bread_sales', function (Blueprint $table) {

            $table->id();
            $table->decimal('sell_at_price', 8, 2);
            $table->decimal('quantity', 8, 2);
            $table->decimal('paid_amount', 8, 2);
            $table->foreignId('bread_price_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_bread_sales');
    }
};
