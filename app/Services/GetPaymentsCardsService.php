<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;

class GetPaymentsCardsService
{




    public function getData($cardId)
    {
        $card = Card::find($cardId);


        $payment = Payment::where('card_id', $card->id)
            /*  ->where('month_id', $month->id) */
            ->first();


        if (!$card) {
            return ['total' => 0, 'paid' => 0, 'remaining' => 0, "status" => null];
        }


        $paid = $payment->paid_amount ?? 0;
        $total = $payment->total ?? 0;

        $remaining = max(0, $total - $paid);

        $status = $card->status ?? "غير مدفوع";

        return [
            'total' => $total,
            'paid' => $paid,
            'remaining' => $remaining,
            'status' => $status
        ];
    }
}
