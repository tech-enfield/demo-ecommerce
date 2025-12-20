<?php

namespace App\Exports\Attribute;

use App\Models\Attribute;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AttributeSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attribute::all();
    }

    public function title(): string
    {
        return 'Attribute';
    }

    public function headings(): array
    {
        return array_filter(
            Schema::getColumnListing((new Attribute())->getTable()),
            fn($col) => !in_array($col, ['created_at', 'updated_at'])
        );
        // return Schema::getColumnListing((new Attribute())->getTable());
    }
}
