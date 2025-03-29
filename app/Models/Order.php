<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'status',
        'payment_method',
        'total_price',
        'discount',
        'shipping_cost',
        'payment_status',
        'address_id',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    static function boot()
    {
        static::creating((function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        }));
    }
}
