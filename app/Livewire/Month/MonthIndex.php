<?php

namespace App\Livewire\Month;

use Livewire\Component;
use App\Models\Month;

class MonthIndex extends Component
{
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

    public function delete($id)
    {
        Month::findOrFail($id)->delete();
        session()->flash('message', 'تم الحذف بنجاح');
    }
    public function render()
    {
        return view('livewire.months.index', [
            'months' => Month::latest()->get()
        ]);
    }
}
