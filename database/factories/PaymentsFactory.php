<?php

namespace Database\Factories;

use App\Models\BreadPrice;
use App\Models\Card;
use App\Models\Months;
use App\Models\Payments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
 */
class PaymentsFactory extends Factory
{
    protected $model = Payments::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $card = Card::inRandomOrder()->first() ?? Card::factory()->create();
        $month_id = Months::inRandomOrder()->first() ?? Months::factory()->create();
        $breadPrice = .2;
        $members = $card->members;
        $total = $breadPrice * $members * 30;
        return [
            'card_id' => $card->id,
            'month_id' => $month_id,
            'bread_price' => $breadPrice,
            'members' => $members,
            'total' => $total,
            'paid_amount' => fake()->numberBetween(0, $total),
        ];
    }
}
