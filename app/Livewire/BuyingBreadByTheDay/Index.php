<?php

namespace App\Livewire\BuyingBreadByTheDay;

use Livewire\Component;
use App\Models\BuyingBreadByTheDay;

class Index extends Component
{
    public function delete($id)
    {
        BuyingBreadByTheDay::findOrFail($id)->delete();

        session()->flash('message', 'تم الحذف بنجاح 🗑️');
    }

    public function render()
    {
        return view('livewire.buying-bread-by-the-day.index', [
            'records' => BuyingBreadByTheDay::latest()->get()
        ]);
    }
}
