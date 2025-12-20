<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantColor extends BaseModel
{
    public function productVariant(){
        return $this->belongsTo(ProductVariant::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
