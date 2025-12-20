<?php

namespace App\Imports;

use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Spatie\SimpleExcel\SimpleExcelReader;

class AttributeImport
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
        $this->attributeGroup($path);
        $this->attribute($path);
        $this->attributeValue($path);
    }

    public function attributeGroup($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Attribute Group')->getRows();

        $rows->each(function(array $row){
            AttributeGroup::updateOrCreate($row);
        });
    }

    public function attribute($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Attribute')->getRows();

        $rows->each(function(array $row){
            Attribute::updateOrCreate($row);
        });
    }

    public function attributeValue($path)
    {
        $rows = SimpleExcelReader::create($path)->fromSheetName('Attribute Value')->getRows();

        $rows->each(function(array $row){
            AttributeValue::updateOrCreate($row);
        });
    }
}
