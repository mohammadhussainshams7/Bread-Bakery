<?php

namespace App\Livewire\UnpaidCards;

use App\Models\Card;
use App\Models\Month;
use App\Services\UnpayedCard;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = null;
    public $selectedMonthSearch = null;

    public $months;
    public $arbMonths = [
        1 => 'يناير',
        2 => 'فبراير',
        3 => 'مارس',
        4 => 'أبريل',
        5 => 'مايو',
        6 => 'يونيو',
        7 => 'يوليو',
        8 => 'أغسطس',
        9 => 'سبتمبر',
        10 => 'أكتوبر',
        11 => 'نوفمبر',
        12 => 'ديسمبر'
    ];

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
        $monthId = $this->selectedMonthSearch ?? Month::latest()->first()->id;

        // 1️⃣ جلب البيانات مع البحث فقط
        $cards = Card::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->get();

        // 2️⃣ حساب status لكل بطاقة
        $cards = $cards->map(function ($card) use ($service, $monthId) {
            $payment = $service->calculate($card->id, $monthId);

            $card->total = $payment['total'];
            $card->paid = $payment['paid'];
            $card->remaining = $payment['remaining'];
            $card->status = $payment['status'];
            return $card;
        });

        // 3️⃣ فلترة حسب الحالة
        if ($this->statusFilter) {
            $cards = $cards->filter(fn($card) => $card->status === $this->statusFilter);
        }

        // 4️⃣ تجاهل البطاقات التي تم دفعها بالكامل
        $cards = $cards->filter(fn($card) => $card->status != 'تم الدفع');

        // 5️⃣ تحويل Collection إلى Paginator يدويًا
        $perPage = 10;
        $currentPage = $this->page ?? 1;
        $paginatedCards = new LengthAwarePaginator(
            $cards->forPage($currentPage, $perPage)->values(),
            $cards->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('livewire.unpaid-cards.index', [
            'cards' => $paginatedCards,
            'months' => Month::all(), // لإظهار قائمة الأشهر في واجهة المستخدم
        ]);
    }
}
