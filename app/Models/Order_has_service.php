<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_has_service extends Model
{
    // protected $table = 'order_has_services';
    // protected $primaryKey = 'id';
    protected $fillable = [
        'order_id', 
        'service_id',
        'weight',
        'qty',
        'cus_service_rate',
        'wh_service_rate'
    ];
}
