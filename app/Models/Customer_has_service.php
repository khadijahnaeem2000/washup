<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Customer_has_service extends Model
{
    protected $fillable = [
       'customer_id',
       'service_id',
       'service_rate',
       'status',
    ];
}
