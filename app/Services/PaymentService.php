<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;
use App\Models\BreadPrice;
/* use App\Models\Transaction; */
use Illuminate\Support\Facades\DB;

class PaymentService
{
    private const BREAD_PER_PERSON = 5;
    private $breadPriceWithCard = "";
    private $freeBreadPrice = "";
    private $freeBreadPerMonth = "";
    private $daysInMonth = "";
    private $total = "";
    /**
     * Calculate the total amount for a card and month
     */
    public function calculateTotal(Card $card, Month $month): float
    {
        $prices = BreadPrice::whereIn('type', ['بالبطاقة', 'حر'])
            ->pluck('price', 'type');

        $this->breadPriceWithCard = $prices['بالبطاقة'] ?? 0;
        $this->freeBreadPrice = $prices['حر'] ?? 0;
        $this->freeBreadPerMonth = $card->free_bread_per_month ?? 0;
        $this->daysInMonth = $month->number_of_days_in_the_month ?? 0;

        $this->total = $card->members * $this->breadPriceWithCard * self::BREAD_PER_PERSON * $this->daysInMonth;

        if ($this->freeBreadPerMonth > 0) {
            $this->total += $this->freeBreadPrice * $this->daysInMonth * $this->freeBreadPerMonth;
        }

        return $this->total;
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

        $total = (int) round($total);
        return DB::transaction(function () use ($card, $month, $paidAmount, $total) {


            $payment = Payment::firstOrCreate([
                'card_id' => $card->id,
                'month_id' => $month->id,
                "bread_price" => $this->breadPriceWithCard + $this->freeBreadPrice,
                "members" => $card->members,
                "total" => $total,
            ]);


            // ✅ Recalculate total paid
            $totalPaid =  $paidAmount;

            $payment->paid_amount = $totalPaid;
            // ✅ Status
            $remaining = $total - $totalPaid;

            if ($remaining <= 0) {
                $payment->status = PaymentStatus::PAID;
            } elseif ($totalPaid > 0) {
                $payment->status = PaymentStatus::PARTIAL;
            } else {
                $payment->status = PaymentStatus::UNPAID;
            }
            $payment->save();


            return $payment;
        });
    }
}
