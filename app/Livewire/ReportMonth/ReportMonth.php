<?php

namespace App\Livewire\ReportMonth;

use App\Models\Card;
use App\Models\Month;
use App\Models\Payment;
use App\Models\BuyingBreadByTheDay;
use App\Services\PaymentService;
use App\Livewire\Concerns\HasArabicMonths;
use App\Models\FreeBreadSales;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ReportMonth extends Component
{
    use WithPagination, HasArabicMonths;

    public ?int $selectedMonthId = null;
    /** @var \Illuminate\Database\Eloquent\Collection */
    public $months;

    public function mount()
    {
        $this->months = Month::orderBy('year', 'desc')
            ->orderBy('month_number', 'desc')
            ->get();

        if ($this->months->isNotEmpty() && !$this->selectedMonthId) {
            $this->selectedMonthId = $this->months->first()->id;
        }
    }

    public function updatedSelectedMonthId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $report = $this->selectedMonthId ? $this->generateReport($this->selectedMonthId) : $this->emptyReport();

        return view('livewire.report-month.report-month', compact('report'));
    }

    private function generateReport(int $monthId): array
    {
        $month = Month::query()->find($monthId);

        if (!$month) {
            return $this->emptyReport();
        }

        $paymentService = new PaymentService();
        $payments = Payment::with('card')
            ->where('month_id', $month->id)
            ->get();

        $paidCount = 0;
        $partialCount = 0;
        $unpaidCount = 0;
        $totalPaid = 0;
        $totalUnpaid = 0;
        $cardBreadSold = 0;
        $nameCardsPaid = [];
        $nameCardsUnpaid = [];
        $nameCardsPartial = [];
        foreach (Card::all() as $card) {
            $payment = $payments->firstWhere('card_id', $card->id);
            $total = $paymentService->calculateTotal($card, $month);
            $paidAmount = $payment->paid_amount ?? 0;


            if ($paidAmount <= 0) {
                $unpaidCount++;
                $nameCardsUnpaid[$unpaidCount] = $card->name;
            } elseif ($paidAmount < $total) {
                $partialCount++;
                $nameCardsPartial[$partialCount] = $card->name;
            } else {
                $paidCount++;
                $nameCardsPaid[$paidCount] = $card->name;
            }

            $totalPaid += $paidAmount;
            $totalUnpaid += max(0, $total - $paidAmount);
            $cardBreadSold += ($card->members * 5 + ($card->free_bread_per_month ?? 0)) * $month->number_of_days_in_the_month;
        }

        $startDate = Carbon::createFromDate($month->year, $month->month_number, 1)->startOfDay();
        $endDate = $startDate->copy()->endOfMonth()->endOfDay();

        $cashRecords = BuyingBreadByTheDay::query()
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();
        $cashRecordssellfreebread = FreeBreadSales::query()
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

        $cashBreadSold = $cashRecords->sum(function ($record) {
            return ($record->members ?? 0) * 5 * ($record->countdays ?? 0);
        });
        $cashBreadSold = $cashRecordssellfreebread->sum(function ($record) {
            return ($record->quantity ?? 0);
        });
        $cashSalesTotal = $cashRecords->sum(fn($record) => $record->total ?? 0);
        /* dd($cashSalesTotal); */
        $cashSalesTotal = $cashRecordssellfreebread->sum(fn($record) => $record->paid_amount ?? 0);
        return [
            'month' => $month,
            'cardBreadSold' => $cardBreadSold,
            'cashBreadSold' => $cashBreadSold,
            'totalBreadSold' => $cardBreadSold + $cashBreadSold,
            'paidCount' => $paidCount,
            'partialCount' => $partialCount,
            'unpaidCount' => $unpaidCount,
            'totalPaid' => round($totalPaid, 2),
            'totalUnpaid' => round($totalUnpaid, 2),
            'cashSalesTotal' => round($cashSalesTotal, 2),
            'cashRecordsCount' => $cashRecords->count(),
            "nameCardsPaid" => $nameCardsPaid,
            "nameCardsUnpaid" => $nameCardsUnpaid,
            "nameCardsPartial" => $nameCardsPartial,
        ];
    }

    private function emptyReport(): array
    {
        return [
            'month' => null,
            'cardBreadSold' => 0,
            'cashBreadSold' => 0,
            'totalBreadSold' => 0,
            'paidCount' => 0,
            'partialCount' => 0,
            'unpaidCount' => 0,
            'totalPaid' => 0,
            'totalUnpaid' => 0,
            'cashSalesTotal' => 0,
            'cashRecordsCount' => 0,
            'nameCardsPaid' => [],
            'nameCardsPartial' => [],
            'nameCardsUnpaid' => [],
        ];
    }
}
