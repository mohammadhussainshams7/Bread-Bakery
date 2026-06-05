<?php

namespace App\Livewire\Payments;

use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;
use App\Services\GetPaymentsCardsService;
use App\Services\PaymentService;
use App\Livewire\Concerns\HasArabicMonths;
use Illuminate\Pagination\LengthAwarePaginator;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, HasArabicMonths;




    public $search = '';

    public array $paidAmounts = [];
    public $stutus = null;

    /**
     * تحديد الشهر الافتراضي مرة واحدة فقط
     */


    public function updatingSearch()
    {
        $this->resetPage();
        $this->paidAmounts = [];
    }

    public function updatedPaidAmounts($value, $key)
    {

        $amount = (float) $value;

        if (str_contains($key, '_')) {
            [$cardId, $monthId] = explode('_', $key, 2);

            app(PaymentService::class)->addPayment(
                (int) $cardId,
                (int) $monthId,
                $amount,
            );
        } else {
            app(PaymentService::class)->addPayment(
                $key,
                $this->selectedMonthSearch,
                $amount
            );
        }

        unset($this->paidAmounts[$key]);

        session()->flash('success', 'تم التحديث');
    }


    public function render(GetPaymentsCardsService $service)
    {
        if ($this->search) {
            $cards = Card::query()
                ->where('name', 'like', "%{$this->search}%")
                ->get();

            $months = Month::orderBy('year', 'desc')
                ->orderBy('month_number', 'desc')
                ->get();

            $paymentService = app(PaymentService::class);
            $rows = collect();

            foreach ($cards as $card) {
                foreach ($months as $month) {
                    $payment = Payment::where('card_id', $card->id)
                        ->where('month_id', $month->id)
                        ->first();

                    $paid = $payment->paid_amount ?? 0;
                    $total = $payment->total ?? $paymentService->calculateTotal($card, $month);
                    $remaining = max(0, $total - $paid);
                    $status = $payment->status ?? 'غير مدفوع';
                    $styleClassStatus = $this->getPaymentStatusClass($status, $paid);

                    $rows->push((object) [
                        'key' => "{$card->id}_{$month->id}",
                        'card_id' => $card->id,
                        'month_id' => $month->id,
                        'name' => $card->name,
                        'month_number' => $month->month_number,
                        'month_year' => $month->year,
                        'total' => $total,
                        'paid' => $paid,
                        'remaining' => $remaining,
                        'status' => $status,
                        'styleClassStatus' => $styleClassStatus,
                    ]);
                }
            }

            $page = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;
            $searchRows = new LengthAwarePaginator(
                $rows->forPage($page, $perPage)->values(),
                $rows->count(),
                $perPage,
                $page,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );

            foreach ($searchRows as $row) {
                if (!isset($this->paidAmounts[$row->key])) {
                    $this->paidAmounts[$row->key] = $row->paid;
                }
            }

            return view('livewire.payments.index', [
                'searchRows' => $searchRows,
                'months' => Month::select('id', 'month_number', 'year')->get(),
            ]);
        }

        return view('livewire.payments.index', [
            'searchRows' => null,
            'months' => Month::select('id', 'month_number', 'year')->get(),
        ]);
    }
}
