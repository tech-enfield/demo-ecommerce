<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
