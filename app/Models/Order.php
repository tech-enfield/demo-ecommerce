<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function shippingProvince()
    {
        return $this->belongsTo(Province::class, 'shipping_province_id');
    }

    public function shippingDistrict()
    {
        return $this->belongsTo(District::class, 'shipping_district_id');
    }

    public function shippingMunicipality()
    {
        return $this->belongsTo(Municipality::class, 'shipping_municipality_id');
    }

    public function billingProvince()
    {
        return $this->belongsTo(Province::class, 'billing_province_id');
    }

    public function billingDistrict()
    {
        return $this->belongsTo(District::class, 'billing_district_id');
    }

    public function billingMunicipality()
    {
        return $this->belongsTo(Municipality::class, 'billing_municipality_id');
    }
}
