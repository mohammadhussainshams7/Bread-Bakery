<?php

namespace App\Imports;

use App\Models\Card;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CardImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Card([
            "name" => $row['name'],
            "members" => $row['members'],
            "free_bread_per_month" => $row['free_bread_per_month'],
        ]);
    }
    public function uniqueBy()
    {
        return 'name';
    }
}
