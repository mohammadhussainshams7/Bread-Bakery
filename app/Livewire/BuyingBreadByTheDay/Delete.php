<?php

namespace App\Livewire\BuyingBreadByTheDay;

use Livewire\Component;
use App\Models\BuyingBreadByTheDay;

class Delete extends Component
{
    public BuyingBreadByTheDay $record;

    public function mount(BuyingBreadByTheDay $buyingBreadByTheDay)
    {
        $this->record = $buyingBreadByTheDay;
    }

    public function delete()
    {
        $this->record->delete();
        session()->flash('message', 'تم الحذف بنجاح ✅');
        return redirect()->route('buyingbread.index');
    }

    public function render()
    {
        return view('livewire.buying-bread-by-the-day.delete');
    }
}
