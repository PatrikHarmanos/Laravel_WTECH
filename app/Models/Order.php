<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'email', 'name', 'phone_number', 'address', 'city',
        'psc', 'payment', 'delivery', 'card_number', 'card_expiration', 'card_csv', 'finished', 'totalPrice', 'totalQty'
        ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
