<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wash_house_has_summary extends Model
{
    protected $fillable = [
        'order_id',
        'wash_house_id',
    ];
}
