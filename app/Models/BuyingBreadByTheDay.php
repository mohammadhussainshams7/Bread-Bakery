<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyingBreadByTheDay extends Model
{

    protected $fillable = [
        'name',
        'total',
        'members',
        'countdays',
    ];
}
