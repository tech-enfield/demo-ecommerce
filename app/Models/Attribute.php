<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attribute extends BaseModel
{
    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            // Generate slug if empty
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);

                // Ensure unique slug
                $originalSlug = $model->slug;
                $i = 1;
                while (Attribute::where('slug', $model->slug)->exists()) {
                    $model->slug = $originalSlug . '-' . $i++;
                }
            }
        });
    }

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id');
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }
}
