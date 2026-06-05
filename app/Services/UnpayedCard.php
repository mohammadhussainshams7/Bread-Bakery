<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\BreadPrice;
use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;

class UnpayedCard
{
    private $total, $paid, $breadPerPerson = 5, $breadPriceWithCard, $remaining;




    public function calculate(Card $card, Month $month)
    {
        // Get bread prices مرة واحدة (يفضل تتحط cache)
        $prices = BreadPrice::whereIn('type', ['بالبطاقة', 'حر'])
            ->pluck('price', 'type');

        $breadPriceWithCard = $prices['بالبطاقة'] ?? 0;
        $freeBreadPrice = $prices['حر'] ?? 0;

        $daysInMonth = $month->number_of_days_in_the_month ?? 0;

        $total = ($card->members * $breadPriceWithCard * 5 * $daysInMonth);

        if ($card->free_bread_per_month > 0) {
            $total += ($freeBreadPrice * $daysInMonth * $card->free_bread_per_month);
        }

        $paid = Payment::where('card_id', $card->id)
            ->where('month_id', $month->id)
            ->sum('paid_amount');
        $total = (int) $total;
        $remaining = max(0, $total - $paid);

        // Status منطقي ونظيف
        if ($paid == 0) {
            $status = PaymentStatus::UNPAID;
        } elseif ($remaining > 0) {
            $status = PaymentStatus::PARTIAL;
        } else {
            $status = PaymentStatus::PAID;
        }

        return compact('total', 'paid', 'remaining', 'status');
    }
}
