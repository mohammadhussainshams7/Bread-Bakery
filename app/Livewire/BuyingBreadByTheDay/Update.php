<?php

namespace App\Livewire\BuyingBreadByTheDay;

use Livewire\Component;
use App\Models\BuyingBreadByTheDay;
use App\Services\BuyingBreadByTheDay as BuyingBreadService;

class Update extends Component
{
    public $recordId;
    public $name, $members, $countdays, $total = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'members' => 'required|integer|min:1',
        'countdays' => 'required|integer|min:1',
    ];

    protected $service;

    public function boot(BuyingBreadService $service)
    {
        $this->service = $service;
    }

    // 🔹 Load data
    public function mount($id = null)
    {

        $record = BuyingBreadByTheDay::findOrFail($id);

        $this->recordId = $record->id;
        $this->name = $record->name;
        $this->members = $record->members;
        $this->countdays = $record->countdays;
        $this->total = $record->total;
    }

    // 🔥 Live total update
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

    // ✅ Update
    public function update()
    {
        $this->validate();

        $record = BuyingBreadByTheDay::findOrFail($this->recordId);

        $record->update([
            'name' => $this->name,
            'members' => $this->members,
            'countdays' => $this->countdays,
            'total' => $this->total,
        ]);

        session()->flash('message', 'تم التحديث بنجاح ✏️');

        return redirect()->route('buyingbread.index');
    }

    public function render()
    {
        return view('livewire.buying-bread-by-the-day.update');
    }
}
