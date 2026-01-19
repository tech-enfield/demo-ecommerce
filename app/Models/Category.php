<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {

            // Generate slug if empty
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);

                // Ensure unique slug
                $originalSlug = $category->slug;
                $i = 1;
                while (Category::where('slug', $category->slug)->exists()) {
                    $category->slug = $originalSlug . '-' . $i++;
                }
            }
        });
    }
    
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
