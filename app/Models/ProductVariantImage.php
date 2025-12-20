<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class ProductVariantImage extends BaseModel
{
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
