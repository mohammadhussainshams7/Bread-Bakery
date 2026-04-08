<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BreadPrice;

class FreeBreadSales extends Model
{

    protected $table = 'free_bread_sales';

    protected $fillable = [
        'sell_at_price',
        'quantity',
        'paid_amount',
        'bread_price_id',
    ];
    public function breadPrice()
    {
        return $this->belongsTo(BreadPrice::class);
    }
}
