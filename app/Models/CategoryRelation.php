<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryRelation extends BaseModel
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'id');
    }
}
