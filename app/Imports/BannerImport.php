<?php

namespace App\Imports;

use App\Models\Banner;
use App\Models\Rating;
use Spatie\SimpleExcel\SimpleExcelReader;

class BannerImport
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function import($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Banners')->getRows();

        $rows->each(function ($row) {
            Banner::updateOrCreate($row);
        });

        $this->ratings($path);
    }

    public function ratings($path){
        $rows = SimpleExcelReader::create($path)->fromSheetName('Ratings')->getRows();

        $rows->each(function ($row) {
            Rating::updateOrCreate($row);
        });
    }
}
