<?php

namespace App\Livewire\Payments;

use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;
use App\Services\PaymentService;
use App\Livewire\Concerns\HasArabicMonths;
use Livewire\Component;
use Livewire\WithPagination;

class ShowDetails extends Component
{
    use WithPagination, HasArabicMonths;
    public $id;
    public $datacard;




    public function mount($id)
    {
        $this->id = $id;
        $this->datacard = Card::findOrFail($this->id);
    }

    public function render(PaymentService $service)
    {
        $paymentService = $service;
        $months = Month::orderBy('year', 'desc')
            ->orderBy('month_number', 'desc')
            ->get();

        $paymentDetails = [];
        $totalPaid = 0;
        $totalRemaining = 0;

        foreach ($months as $month) {
            $payment = Payment::where('card_id', $this->id)
                ->where('month_id', $month->id)
                ->first();

            $paid = $payment->paid_amount ?? 0;
            $total = $payment->total ?? $paymentService->calculateTotal($this->datacard, $month);
            $remaining = max(0, $total - $paid);
            $status = $payment->status ?? 'غير مدفوع';
            $styleClassStatus = $this->getPaymentStatusClass($status, $paid);

            $paymentDetails[] = (object) [
                'month_name' => $this->arbMonths[$month->month_number],
                'month_year' => $month->year,
                'total' => $total,
                'paid' => $paid,
                'remaining' => $remaining,
                'status' => $status,
                'styleClassStatus' => $styleClassStatus,
            ];

            $totalPaid += $paid;
            $totalRemaining += $remaining;
        }

        return view('livewire.payments.showDetails', [
            'datacard' => $this->datacard,
            'paymentDetails' => $paymentDetails,
            'totalRequired' => $totalPaid + $totalRemaining,
            'totalPaid' => $totalPaid,
            'totalRemaining' => $totalRemaining,
        ]);
    }
}
