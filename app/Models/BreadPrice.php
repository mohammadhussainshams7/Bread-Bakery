<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreadPrice extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'type'];
    public function freeBreadSales()
    {
        return $this->hasMany(FreeBreadSales::class);
    }
}
