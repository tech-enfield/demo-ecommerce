<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['updated_at', 'created_at'];
}
