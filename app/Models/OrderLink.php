<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class OrderLink extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'order_id','customer_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($orderLink) {
            $orderLink->uuid = (string) Str::uuid();
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
  public function customer(): BelongsTo
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

}
