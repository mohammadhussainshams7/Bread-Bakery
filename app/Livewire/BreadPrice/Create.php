<?php

namespace App\Livewire\BreadPrice;

use Livewire\Component;
use App\Models\BreadPrice;

class Create extends Component
{
    public $price = 0;
    public $type = '';

    protected $rules = [
        'price' => 'required|numeric|min:0',
        'type' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        BreadPrice::create([
            'price' => $this->price,
            'type' => $this->type,
        ]);

        session()->flash('message', 'تم إضافة السعر بنجاح!');
        return redirect()->route('breadprice.index');
    }

    public function render()
    {
        return view('livewire.bread-price.create');
    }
}
