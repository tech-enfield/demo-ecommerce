<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class AttributeValue extends BaseModel
{
    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            // Generate slug if empty
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->value);

                // Ensure unique slug
                $originalSlug = $model->slug;
                $i = 1;
                while (AttributeValue::where('slug', $model->slug)->exists()) {
                    $model->slug = $originalSlug . '-' . $i++;
                }
            }
        });
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
