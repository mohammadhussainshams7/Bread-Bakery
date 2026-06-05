<?php

namespace App\Livewire\UnpaidCards;

use App\Models\Card;
use App\Models\Month;
use App\Services\UnpayedCard;
use App\Livewire\Concerns\HasArabicMonths;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, HasArabicMonths;

    public $search = '';
    public $statusFilter = null;
    public $selectedMonthSearch = null;

    public $months;

    protected $updatesQueryString = ['search', 'statusFilter', 'selectedMonthSearch'];
    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->months = Month::orderBy('year', 'desc')
            ->orderBy('month_number', 'desc')
            ->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    public function updatingSelectedMonthSearch()
    {
        $this->resetPage();
    }

     public function render()
    {

$service = app(UnpayedCard::class);
         $month = Month::find($this->selectedMonthSearch)
    ?? Month::latest()->first();
$cards = Card::query()
    ->when($this->search, function ($q) {
        $q->where('name', 'like', "%{$this->search}%");
    })
    ->get(); // ✅ بدون paginate

$collection = $cards->map(function ($card) use ($service, $month) {
    $payment = $service->calculate($card, $month);

    $card->total = $payment['total'];
    $card->month = $this->arbMonths[$month->month_number] . ' / ' . $month->year;
    $card->paid = $payment['paid'];
    $card->remaining = $payment['remaining'];
    $card->status = $payment['status'];

    return $card;
});

// فلترة
$collection = $collection->filter(function ($card) {
    return $card->status !== 'تم الدفع';
});

if ($this->statusFilter) {
    $collection = $collection->where('status', $this->statusFilter);
}

// pagination يدوي
$page = LengthAwarePaginator::resolveCurrentPage();
$perPage = 10;

	$paginatedCards = new LengthAwarePaginator(
    $collection->forPage($page, $perPage)->values(),
    $collection->count(),
    $perPage,
    $page,
    [
        'path' => request()->url(),
        'query' => request()->query(), // مهم مع الفلاتر
    ]
);
 
        return view('livewire.unpaid-cards.index', [
    'paginatedCards' => $paginatedCards,
    'months' => $this->months,
]);
    }
}
