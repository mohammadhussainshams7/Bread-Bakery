<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'members', "free_bread_per_month"];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
