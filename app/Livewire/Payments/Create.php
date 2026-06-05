<?php

namespace App\Livewire\Payments;

use App\Livewire\Concerns\HasArabicMonths;
use Livewire\Component;
use App\Models\Card;
use App\Models\Month;
use App\Services\PaymentService;

class Create extends Component
{
    use HasArabicMonths;
    public $cardSearch = '';
    public $selectedCardId = null;
    public $selectedMonth = null;
    public $paidAmount = null;
    public $remainingAmount = 0;

    public $months = [];

    protected PaymentService $paymentService;




    public function boot(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function mount()
    {
        $this->months = Month::select('id', 'month_number', 'year')->get();
    }

    public function getFilteredCards()
    {
        if (strlen($this->cardSearch) < 2) return [];

        return Card::where('name', 'like', "%{$this->cardSearch}%")
            ->limit(5)
            ->get();
    }

    public function selectCard($id)
    {
        $card = Card::find($id);

        if ($card) {
            $this->cardSearch = $card->name;
            $this->selectedCardId = $card->id;
            $this->updateRemaining();
        }
    }

    public function updated($field)
    {
        if (in_array($field, ['selectedCardId', 'selectedMonth'])) {
            $this->updateRemaining();
        }
    }

    public function updateRemaining()
    {
        if (!$this->selectedCardId || !$this->selectedMonth) {
            $this->remainingAmount = 0;
            return;
        }

        $this->remainingAmount = $this->paymentService
            ->calculateRemaining($this->selectedCardId, $this->selectedMonth);
    }

    public function save()
    {
        $this->validate([
            'selectedCardId' => 'required|exists:cards,id',
            'selectedMonth' => 'required|exists:months,id',
            'paidAmount' => 'required|numeric|min:0',
        ]);

        $this->paymentService->addPayment(
            $this->selectedCardId,
            $this->selectedMonth,
            $this->paidAmount
        );

        session()->flash('message', 'تم تسجيل الدفع ✅');

        // إعادة تعيين القيم (تفريغ الفورم)
        $this->reset(['paidAmount', 'selectedMonth', 'selectedCardId', 'cardSearch', 'remainingAmount']);
    }

    public function render()
    {
        return view('livewire.payments.create');
    }
}
