<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends BaseModel
{
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
