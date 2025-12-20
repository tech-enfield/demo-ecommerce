<?php

namespace App\Exports;

use App\Models\Category;
use Spatie\SimpleExcel\SimpleExcelWriter;

class CategoryExport
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function export()
    {
        $data = Category::all()->toArray();

        return SimpleExcelWriter::streamDownload('export-category-' . time() . '.xlsx')
            ->addRows($data);
    }
}
