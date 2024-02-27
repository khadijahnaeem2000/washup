<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'hanger',
        'qty',
        'unit_id',
        'rate',
        'description',
        'image',
        'web_image',
        'status',
        'created_by',
        'updated_by',
    ];

    public function unit()
    {
        return $this->hasOne('App\Models\Unit');
    }

    
}
