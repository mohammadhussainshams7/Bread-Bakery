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
        Schema::create('buying_bread_by_the_days', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal("total", 8, 2);
            $table->integer('members');
            $table->integer('countdays');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buying_bread_by_the_days');
    }
};
