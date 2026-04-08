<?php

namespace Database\Factories;

use App\Models\BreadPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BreadFactory extends Factory
{

    protected $model = BreadPrice::class;
    public function definition(): array
    {
        return [
            [
                'price' => 0.20,        // سعر محدد
                'type' => 'البطاقة',    // النوع محدد

            ]
        ];
    }

    // State للنوع "البطاقة"
    public function البطاقة()
    {
        return $this->state(fn(array $attributes) => [
            'price' => 0.20,
            'type' => 'البطاقة',
        ]);
    }

    // State للنوع "حر"
    public function حر()
    {
        return $this->state(fn(array $attributes) => [
            'price' => 1.66,
            'type' => 'حر',
        ]);
    }
}
