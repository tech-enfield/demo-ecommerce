<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends BaseModel
{
    public function saleEnteredBy()
    {
        return $this->belongsTo(User::class, 'sale_entry_by', 'id');
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
