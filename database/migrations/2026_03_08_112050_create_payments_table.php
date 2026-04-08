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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('month_id')->nullable()->constrained('months');
            $table->decimal('bread_price', 8, 2); // سعر الرغيف
            $table->integer('members');           // عدد الأفراد (نسخة للراحة)
            $table->decimal('total', 8, 2);       // المطلوب = members * bread_price
            $table->decimal('paid_amount', 8, 2)->default(0); // المدفوع حتى الآن
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
