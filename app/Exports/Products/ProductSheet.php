<?php

namespace App\Exports\Products;

use Maatwebsite\Excel\Concerns\FromCollection;

class ProductSheet implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
