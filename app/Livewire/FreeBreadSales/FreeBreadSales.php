<?php

namespace App\Livewire\FreeBreadSales;

use Livewire\Component;
use App\Models\FreeBreadSales as FreeBreadSale;
use App\Models\BreadPrice;
use App\Models\Transactions;

class FreeBreadSales extends Component
{
    public $sellAmount = 0;
    public $editId = null;

    protected $rules = [
        'sellAmount' => 'required|numeric|min:1',
    ];

    // ✅ سعر الرغيف
    public function getBreadPriceProperty()
    {
        return BreadPrice::where('type', 'حر')->first();
    }

    // ✅ الإجمالي (محسوب تلقائي)
    public function getTotalPriceProperty()
    {
        return $this->sellAmount * ($this->breadPrice->price ?? 0);
    }

    // ✅ حفظ
    public function save()
    {
        $this->validate();

        $price = $this->breadPrice;

        if (!$price) {
            session()->flash('error', 'سعر العيش غير موجود!');
            return;
        }

        $data = [
            'sell_at_price' => $price->price,
            'quantity' => $this->sellAmount,
            'paid_amount' => $this->totalPrice,
            'bread_price_id' => $price->id,
        ];

        if ($this->editId) {
            FreeBreadSale::findOrFail($this->editId)->update($data);

            session()->flash('message', 'تم تعديل البيع بنجاح!');
        } else {
            $sale = FreeBreadSale::create($data);

            /*       Transactions::create([
                'free_bread_sale_id' => $sale->id,
                'amount' => $this->totalPrice,
                'paid_at' => now(),
            ]); */

            session()->flash('message', 'تم تسجيل البيع بنجاح!');
        }

        $this->resetForm();
    }

    // ✅ تعديل
    public function edit($id)
    {
        $sale = FreeBreadSale::findOrFail($id);

        $this->editId = $sale->id;
        $this->sellAmount = $sale->quantity;
    }

    // ✅ حذف
    public function delete($id)
    {
        FreeBreadSale::findOrFail($id)->delete();

        session()->flash('message', 'تم حذف البيع بنجاح!');
    }

    // ✅ إعادة ضبط
    public function resetForm()
    {
        $this->reset(['sellAmount', 'editId']);
    }

    public function render()
    {
        return view('livewire.free-bread-sales.index', [
            'sales' => FreeBreadSale::latest()->get(),
        ]);
    }
}
