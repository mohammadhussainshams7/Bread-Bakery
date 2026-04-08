<?php

namespace App\Livewire\BreadPrice;

use Livewire\Component;
use App\Models\BreadPrice;

class Delete extends Component
{
    protected $listeners = ['deleteRecord'];

    public function deleteRecord($id)
    {
        BreadPrice::findOrFail($id)->delete();

        session()->flash('message', 'تم الحذف بنجاح ✅');

        $this->emit('recordUpdated');
    }

    public function render()
    {
        return view('livewire.bread-price.delete');
    }
}
