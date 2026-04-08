<?php

namespace App\Livewire\Cards;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Card;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Card $card)
    {
        $card->delete();

        $this->dispatch('notify', message: 'تم الحذف بنجاح');
    }

    public function render()
    {
        return view('livewire.cards.index', [
            'cards' => Card::query()
                ->where('name', 'like', "%{$this->search}%")
                ->latest()
                ->paginate(10),
        ]);
    }
}
