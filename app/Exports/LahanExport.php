<?php

namespace App\Exports;

use App\model\lahan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LahanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return lahan::all();
    }
}
