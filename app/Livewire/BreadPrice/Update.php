<?php

namespace App\Livewire\BreadPrice;

use Livewire\Component;
use App\Models\BreadPrice;

class Update extends Component
{
    public BreadPrice $breadPrice;
    public $price;
    public $type;

    protected $rules = [
        'price' => 'required|numeric|min:0',
        'type' => 'required|string',
    ];

    public function mount(BreadPrice $breadPrice)
    {
        $this->breadPrice = $breadPrice;
        $this->price = $breadPrice->price;
        $this->type = $breadPrice->type;
    }

    public function save()
    {
        $this->validate();

        $this->breadPrice->update([
            'price' => $this->price,
            'type' => $this->type,
        ]);

        session()->flash('message', 'تم التحديث بنجاح!');
        return redirect()->route('breadprice.index');
    }

    public function render()
    {
        return view('livewire.bread-price.update');
    }
}
