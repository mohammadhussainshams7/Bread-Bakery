<?php

namespace App\Livewire\Month;

use App\Livewire\Concerns\HasArabicMonths;
use Livewire\Component;
use App\Models\Month;

class MonthIndex extends Component
{
    use HasArabicMonths;


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
