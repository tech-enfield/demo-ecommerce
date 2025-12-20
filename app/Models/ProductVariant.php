<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductVariant extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (empty($model->slug)) {
                $model->slug = $model->product->slug . '-' . Str::slug($model->title);

                // Ensure unique slug
                $originalSlug = $model->slug;
                $i = 1;
                while (ProductVariant::where('slug', $model->slug)->exists()) {
                    $model->slug = $originalSlug . '-' . $i++;
                }
            }

            // Auto meta title
            if (empty($model->meta_title)) {
                $model->meta_title = $model->title . ' | Store 9 Nepal';
            }

            // Auto meta description
            if (empty($model->meta_description)) {
                $model->meta_description =
                    "Explore the best {$model->title} in Nepal. Shop genuine products at the best price with fast delivery.";
            }

            // Auto keywords (optional)
            // if (empty($model->meta_keywords)) {
            //     $model->meta_keywords = strtolower($model->title) . ', nepali ' . strtolower($model->title);
            // }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImagesAttribute()
    {
        return $this->product?->images;
    }

    public function getNameAttribute()
    {
        return $this->product?->name . ' | ' . $this->title;
    }

    public function getShortDescriptionAttribute()
    {
        return $this->product?->short_description;
    }

    public function getDescriptionAttribute()
    {
        return $this->product?->description;
    }

    public function getCategoriesAttribute()
    {
        return $this->product?->categories;
    }

    // public function images()
    // {
    //     return $this->hasMany(ProductVariantImage::class);
    // }

    public function colors()
    {
        return $this->hasMany(ProductVariantColor::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
