<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends BaseModel
{
        public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

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

            // Auto meta title
            // if (empty($category->meta_title)) {
            //     $category->meta_title = $category->name . '';
            // }

            // // Auto meta description
            // if (empty($category->meta_description)) {
            //     $category->meta_description =
            //         "Explore the best {$category->name} in Nepal. Shop genuine products at the best price with fast delivery.";
            // }

            // // Auto keywords (optional)
            // if (empty($category->meta_keywords)) {
            //     $category->meta_keywords = strtolower($category->name) . ', nepali ' . strtolower($category->name);
            // }
        });
    }
}
