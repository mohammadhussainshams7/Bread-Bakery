<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Card;
use App\Models\Month;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['card_id', 'month_id', 'bread_price', 'members', "status", 'total', 'paid_amount'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class); // Transaction مفرد
    }
}
