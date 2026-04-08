<?php

namespace App\Livewire\Cards;

use Livewire\Component;
use App\Models\Card;

class Create extends Component
{
    public $name;
    public $members;
    public $free_bread_per_month = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'members' => 'required|integer|min:1',
        'free_bread_per_month' => 'nullable|integer|min:0',
    ];

    public function save()
    {
        $this->validate();

        Card::create([
            'name' => $this->name,
            'members' => $this->members,
            'free_bread_per_month' => $this->free_bread_per_month,
        ]);

        return redirect()->route('cards.index');
    }

    public function render()
    {
        return view('livewire.cards.create');
    }
}
