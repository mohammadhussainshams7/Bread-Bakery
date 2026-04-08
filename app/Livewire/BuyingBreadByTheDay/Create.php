<?php

namespace App\Livewire\BuyingBreadByTheDay;

use Livewire\Component;
use App\Services\BuyingBreadByTheDay;
use App\Models\BuyingBreadByTheDay as Model;

class Create extends Component
{
    public $name, $members, $countdays, $total = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'members' => 'required|integer|min:1',
        'countdays' => 'required|integer|min:1',
    ];

    protected $service;

    public function boot(BuyingBreadByTheDay $service)
    {
        $this->service = $service;
    }

    // 🔥 Live calculation
    public function updated($field)
    {
        if (in_array($field, ['members', 'countdays'])) {

            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {

        if ($this->members && $this->countdays) {
            $this->total = $this->service->calculateTotal(
                $this->countdays,
                $this->members
            );
        }
    }

    // ✅ Store
    public function save()
    {
        $this->validate();

        Model::create([
            'name' => $this->name,
            'members' => $this->members,
            'countdays' => $this->countdays,
            'total' => $this->total,
        ]);

        session()->flash('message', 'تمت الإضافة بنجاح ✅');

        return redirect()->route('buyingbread.index');
    }

    public function render()
    {
        return view('livewire.buying-bread-by-the-day.create');
    }
}
