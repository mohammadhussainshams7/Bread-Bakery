<?php

namespace App\Services;

use App\Models\BreadPrice;

class BuyingBreadByTheDay
{


    function calculateTotal($countdays, $members)
    {

        $breadPerPerson = 5;
        $number_of_days = $number_of_days ?? 0;

        $breadPrice =  BreadPrice::where('type', 'بالبطاقة')
            ->pluck('price')->first() ?? 0;



        $total = $members * $breadPrice * $breadPerPerson * $countdays;
        return $total;
    }
}
