<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductVariant;
use Spatie\SimpleExcel\SimpleExcelReader;

class ProductImport
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function import($path){
        $this->products($path);
        $this->variants($path);
    }

    public function products($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Products')->getRows();

        $rows->each(function ($row) {
            Product::updateOrCreate($row);
        });
    }

    public function variants($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Product Variants')->getRows();

        $rows->each(function ($row) {
            ProductVariant::updateOrCreate($row);
        });
    }
}
