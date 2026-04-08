<?php

namespace App\Livewire\Month;

use Livewire\Component;
use App\Models\Month;
use Carbon\Carbon;

class MonthCreate extends Component
{
    public $month_number;
    public $year;
    public $number_of_days_in_the_month;
    public $arbMonths = [
        1 => 'يناير',
        2 => 'فبراير',
        3 => 'مارس',
        4 => 'ابريل',
        5 => 'مايو',
        6 => 'يونيو',
        7 => 'يوليو',
        8 => 'اغسطس',
        9 => 'سبتمبر',
        10 => 'اكتوبر',
        11 => 'نوفمبر',
        12 => 'ديسمبر'
    ];

    protected function rules()
    {
        return [
            'month_number' => 'required|integer|unique:months,month_number,NULL,id,year,' . $this->year,
            'year' => 'required|integer|min:2024|max:2090'
        ];
    }

    public function updated($property)
    {
        if ($property == 'month_number' || $property == 'year') {
            if ($this->month_number && $this->year) {
                $this->number_of_days_in_the_month = Carbon::create($this->year, $this->month_number)->daysInMonth;
            }
        }
    }

    public function store()
    {
        $this->validate();
        Month::create([
            'month_number' => $this->month_number,
            'year' => $this->year,
            'number_of_days_in_the_month' => $this->number_of_days_in_the_month
        ]);
        session()->flash('message', 'تم إضافة الشهر بنجاح');
        return redirect()->route('months.index');
    }
    public function render()
    {
        return view('livewire.months.create');
    }
}
