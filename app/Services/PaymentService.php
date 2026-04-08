<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;
use App\Models\BreadPrice;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    private const BREAD_PER_PERSON = 5;

    /**
     * Calculate the total amount for a card and month
     */
    public function calculateTotal(Card $card, Month $month): float
    {
        $prices = BreadPrice::whereIn('type', ['بالبطاقة', 'حر'])
            ->pluck('price', 'type');

        $breadPriceWithCard = $prices['بالبطاقة'] ?? 0;
        $freeBreadPrice = $prices['حر'] ?? 0;
        $freeBreadPerMonth = $card->free_bread_per_month ?? 0;
        $daysInMonth = $month->number_of_days_in_the_month ?? 0;

        $total = $card->members * $breadPriceWithCard * self::BREAD_PER_PERSON * $daysInMonth;

        if ($freeBreadPerMonth > 0) {
            $total += $freeBreadPrice * $daysInMonth * $freeBreadPerMonth;
        }

        return $total;
    }

    /**
     * Get remaining amount
     */
    public function calculateRemaining(int $cardId, int $monthId): float
    {
        $card = Card::find($cardId);
        $month = Month::find($monthId);

        if (!$card || !$month) return 0;

        $total = $this->calculateTotal($card, $month);

        $paid = Payment::where('card_id', $card->id)
            ->where('month_id', $month->id)
            ->value('paid_amount') ?? 0;

        return max($total - $paid, 0);
    }

    /**
     * Add or update payment
     */
    public function addPayment(int $cardId, int $monthId, float $paidAmount): Payment
    {
        $card = Card::findOrFail($cardId);
        $month = Month::findOrFail($monthId);

        $total = $this->calculateTotal($card, $month);

        return DB::transaction(function () use ($card, $month, $paidAmount, $total) {

            $payment = Payment::firstOrNew([
                'card_id' => $card->id,
                'month_id' => $month->id,
            ]);

            $payment->bread_price = BreadPrice::where('type', 'بالبطاقة')->value('price') ?? 0;
            $payment->members = $card->members;
            $payment->total = $total;

            $paidSoFar = $payment->paid_amount ?? 0;
            $remaining = $total - $paidSoFar + $paidAmount;

            if ($remaining <= 0) {
                $payment->status = PaymentStatus::PAID;
            } elseif ($paidSoFar + $paidAmount > 0) {
                $payment->status = PaymentStatus::PARTIAL;
            } else {
                $payment->status = PaymentStatus::UNPAID;
            }

            $payment->save();

            if ($paidAmount > 0) {
                $payment->transactions()->create([
                    'amount' => $paidAmount,
                    'paid_at' => now(),
                ]);

                $payment->increment('paid_amount', $paidAmount);
            }

            return $payment;
        });
    }
}
