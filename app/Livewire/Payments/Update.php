<?php

namespace App\Livewire\Payments;

use App\Livewire\Concerns\HasArabicMonths;
use Livewire\Component;
use App\Models\Payment;
use App\Services\PaymentService;

class Update extends Component
{
    use HasArabicMonths;

    public Payment $payment;

    public $paidAmount;
    public $remainingAmount = 0;

    protected PaymentService $paymentService;




    public function boot(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function mount(Payment $payment)
    {
        $this->payment = $payment;
        $this->paidAmount = $payment->paid_amount;
        $this->updateRemainingAmount();
    }

    public function updatedPaidAmount()
    {
        $this->updateRemainingAmount();
    }

    public function updateRemainingAmount()
    {
        // remaining = total - new paid amount
        $this->remainingAmount = $this->payment->total - $this->paidAmount;
    }

    public function updatePayment()
    {
        $this->validate([
            'paidAmount' => 'required|numeric|min:0|max:' . $this->payment->total,
        ]);

        $this->payment->update([
            'paid_amount' => $this->paidAmount,
        ]);

        session()->flash('message', 'تم تحديث المبلغ المدفوع بنجاح!');
    }

    public function render()
    {
        return view('livewire.payments.update');
    }
}
