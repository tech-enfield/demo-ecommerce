<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantAttribute extends BaseModel
{
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
