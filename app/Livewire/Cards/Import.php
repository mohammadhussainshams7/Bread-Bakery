<?php

namespace App\Livewire\Cards;

use Livewire\Component;
use App\Services\CardImportService;

class Import extends Component
{
    public function import(CardImportService $service)
    {
        $service->import();
        session()->flash('success', 'تم الاستيراد');
    }

    public function render()
    {
        return view('livewire.cards.import');
    }
}
