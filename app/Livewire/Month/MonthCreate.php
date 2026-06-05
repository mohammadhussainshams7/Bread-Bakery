<?php

namespace App\Livewire\Month;

use App\Livewire\Concerns\HasArabicMonths;
use Livewire\Component;
use App\Models\Month;
use Carbon\Carbon;

class MonthCreate extends Component
{
    use HasArabicMonths;
    public $month_number;
    public $year;
    public $number_of_days_in_the_month;


    protected function rules()
    {
        return [
            'month_number' => 'required|integer|unique:months,month_number,NULL,id,year,' . $this->year,
            'year' => 'required|integer|min:2024|max:2090'
        ];
    }


    public function store()
    {
        $this->validate();
        $month = $this->validate()['month_number']; // "4"
        $year = $this->validate()['year']; // "2027"

        $days = cal_days_in_month(
            CAL_GREGORIAN,
            (int) $month,
            (int) $year
        );
        Month::create([
            'month_number' => $this->month_number,
            'year' => $this->year,
            'number_of_days_in_the_month' => $days
        ]);
        session()->flash('message', 'تم إضافة الشهر بنجاح');
        return redirect()->route('months.index');
    }
    public function render()
    {
        return view('livewire.months.create');
    }
}
