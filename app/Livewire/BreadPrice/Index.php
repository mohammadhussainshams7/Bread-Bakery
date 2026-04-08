<?php

namespace App\Livewire\BreadPrice;

use Livewire\Component;
use App\Models\BreadPrice;

class Index extends Component
{
    public $records;

    public function mount()
    {
        $this->records = BreadPrice::latest()->get();
    }

    public function render()
    {
        return view('livewire.bread-price.index');
    }
}
