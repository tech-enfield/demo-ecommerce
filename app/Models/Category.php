<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends BaseModel
{
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Products in this category
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
