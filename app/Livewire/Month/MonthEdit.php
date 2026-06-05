<?php

namespace App\Livewire\Month;

use App\Livewire\Concerns\HasArabicMonths;
use Livewire\Component;
use App\Models\Month;
use Carbon\Carbon;

class MonthEdit extends Component
{
    use HasArabicMonths;
    public $month_id;
    public $month_number;
    public $year;
    public $number_of_days_in_the_month;


    public function mount($id)
    {
        $month = Month::findOrFail($id);
        $this->month_id = $month->id;
        $this->month_number = $month->month_number;
        $this->year = $month->year;
        $this->number_of_days_in_the_month = $month->number_of_days_in_the_month;
    }

    protected function rules()
    {
        return [
            'month_number' => 'required|integer|unique:months,month_number,' . $this->month_id . ',id,year,' . $this->year,
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

    public function update()
    {
        $this->validate();
        Month::findOrFail($this->month_id)->update([
            'month_number' => $this->month_number,
            'year' => $this->year,
            'number_of_days_in_the_month' => $this->number_of_days_in_the_month
        ]);
        session()->flash('message', 'تم التحديث بنجاح');
        return redirect()->route('months.index');
    }
    public function render()
    {
        return view('livewire.months.edit');
    }
}
