<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use App\Models\Payment;


class Delete extends Component
{
    public $paymentId;
    public $showModal = false;

    public function mount($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    public function confirmDelete()
    {
        $this->showModal = true;
    }
    public function deletePayment()
    {
        if (!$this->paymentId) return;

        $payment = Payment::find($this->paymentId);
        if (!$payment) {
            session()->flash('error', 'الدفعة غير موجودة!');
            return redirect()->route('payments.index');
        }
        $payment->delete();
        session()->flash('success', 'تم حذف الدفعة بنجاح!');
        return redirect()->route('payments.index');
    }

    public function render()
    {
        return view('livewire.payments.delete');
    }
}
