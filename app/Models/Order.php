<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_method',
        'shipping_amount',
        'notes',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke OrderItem (satu order punya banyak item)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi ke Address (satu order punya satu alamat)
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    // Accessor: $order->total_cost
    public function getTotalCostAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
    public function shippingAddress()
{
    return $this->belongsTo(Address::class, 'shipping_address_id');
}
}
