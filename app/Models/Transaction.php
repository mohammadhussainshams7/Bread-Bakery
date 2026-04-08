<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Transaction  extends Model
{
    protected $fillable = ['payment_id', 'amount', 'paid_at'];


    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
