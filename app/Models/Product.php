<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {

            // Generate slug if empty
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Ensure unique slug
                $originalSlug = $product->slug;
                $i = 1;
                while (Category::where('slug', $product->slug)->exists()) {
                    $product->slug = $originalSlug . '-' . $i++;
                }
            }

            // Auto meta title
            if (empty($product->meta_title)) {
                $product->meta_title = $product->name . ' | Store 9 Nepal';
            }

            // Auto meta description
            if (empty($product->meta_description)) {
                $product->meta_description =
                    "Explore the best {$product->name} in Nepal. Shop genuine products at the best price with fast delivery.";
            }

            // Auto keywords (optional)
            if (empty($product->meta_keywords)) {
                $product->meta_keywords = strtolower($product->name) . ', nepali ' . strtolower($product->name);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function colors(){
        return $this->hasMany(ProductColor::class);
    }

    public function categories(){
        return $this->hasMany(CategoryProduct::class);
    }
}
