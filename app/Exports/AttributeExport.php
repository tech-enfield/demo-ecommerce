<?php

namespace App\Exports;

use App\Exports\Attribute\AttributeGroupSheet;
use App\Exports\Attribute\AttributeSheet;
use App\Exports\Attribute\AttributeValueSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AttributeExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Attribute Groups' => new AttributeGroupSheet(),
            'Attributes' => new AttributeSheet(),
            'Attribute Values' => new AttributeValueSheet(),
        ];
    }
}
