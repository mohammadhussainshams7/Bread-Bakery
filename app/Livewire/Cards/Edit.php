<?php

namespace App\Livewire\Cards;

use Livewire\Component;
use App\Models\Card;

class Edit extends Component
{
    public $card;
    public $name;
    public $members;
    public $free_bread_per_month;

    protected $rules = [
        'name' => 'required|string|max:255',
        'members' => 'required|integer|min:1',
        'free_bread_per_month' => 'nullable|integer|min:0',
    ];

    public function mount(Card $card)
    {
        $this->card = $card;
        $this->name = $card->name;
        $this->members = $card->members;
        $this->free_bread_per_month = $card->free_bread_per_month;
    }

    public function update()
    {
        $this->validate();

        $this->card->update([
            'name' => $this->name,
            'members' => $this->members,
            'free_bread_per_month' => $this->free_bread_per_month,
        ]);

        return redirect()->route('cards.index');
    }

    public function render()
    {
        return view('livewire.cards.edit');
    }
}
