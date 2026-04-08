<?php

namespace Database\Seeders;

use App\Models\BreadPrice;
use Illuminate\Database\Seeder;

class BreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء سجل "البطاقة"
        BreadPrice::factory()->البطاقة()->create();

        // إنشاء سجل "حر"
        BreadPrice::factory()->حر()->create();
    }
}
