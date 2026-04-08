<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use App\Models\Month;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $selectedMonthSearch = null;

    public $months = [];
    public $arbMonths = [
        '1' => 'يناير',
        '2' => 'فبراير',
        '3' => 'مارس',
        '4' => 'ابريل',
        '5' => 'مايو',
        '6' => 'يونيو',
        '7' => 'يوليو',
        '8' => 'اغسطس',
        '9' => 'ستمبر',
        '10' => 'اكتوبر',
        '11' => 'نوفمبر',
        '12' => 'ديسمبر'
    ];

    public function mount()
    {
        $this->months = Month::all();
    }

    // إعادة تعيين الصفحة عند تغيير البحث
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedMonthSearch()
    {
        $this->resetPage();
    }

    // مسح الفلاتر
    public function clearFilters()
    {
        $this->search = '';
        $this->selectedMonthSearch = null;
        $this->resetPage();
    }

    // حالة الدفع
    public function status($payment)
    {
        $remaining = $payment->total - $payment->paid_amount;

        if ($payment->paid_amount == 0) {
            return ['text' => 'لم يدفع', 'color' => 'bg-red-500', 'remaining' => $remaining];
        }

        if ($payment->paid_amount < $payment->total) {
            return ['text' => 'جزئي', 'color' => 'bg-yellow-500', 'remaining' => $remaining];
        }

        return ['text' => 'تم', 'color' => 'bg-green-500', 'remaining' => 0];
    }

    public function render()
    {
        $payments = Payment::with(['card', 'month'])
            ->when($this->search, function ($query) {
                $query->whereHas('card', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            })
            ->when($this->selectedMonthSearch, function ($query) {
                $query->where('month_id', $this->selectedMonthSearch);
            })
            ->latest()
            ->paginate(5);
        return view('livewire.payments.index', [
            'payments' => $payments,
            'months' => $this->months,
        ]);
    }
}
