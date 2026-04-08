<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\BreadPrice;
use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;

class UnpayedCard
{
    public $total, $paid, $breadPerPerson = 5, $breadPriceWithCard, $remaining;




    public function calculate($cardId, $monthId)
    {
        $card = Card::find($cardId);
        $month = Month::find($monthId);

        if (!$card || !$month) {
            return ['total' => 0, 'paid' => 0, 'remaining' => 0];
        }

        // Get bread prices
        $prices = BreadPrice::whereIn('type', ['بالبطاقة', 'حر'])->pluck('price', 'type');
        $breadPriceWithCard = $prices['بالبطاقة'] ?? 0;
        $freeBreadPrice = $prices['حر'] ?? 0;
        $freeBreadPerMonth = $card->free_bread_per_month ?? 0;

        $daysInMonth = $month->number_of_days_in_the_month ?? 0;

        // Calculate total required payment
        $total = ($card->members * $breadPriceWithCard * 5 * $daysInMonth); // 5 = breadPerPerson
        if ($freeBreadPerMonth > 0) {
            $total += ($freeBreadPrice * $daysInMonth * $freeBreadPerMonth);
        }

        // Get total paid so far
        $paid = Payment::where('card_id', $card->id)
            ->where('month_id', $month->id)
            ->sum('paid_amount');

        $remaining = max(0, $total - $paid);

        if ($this->remaining >= $total) {
            $status = PaymentStatus::PAID;
        } elseif ($this->remaining > 0) {
            $status = PaymentStatus::PARTIAL;
        } else {
            $status = PaymentStatus::UNPAID;
        }

        return [
            'total' => $total,
            'paid' => $paid,
            'remaining' => $remaining,
            'status' => $status
        ];
    }
}
