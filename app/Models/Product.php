<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'price', 'image_path', 'category_id', 'description'];

    public function productCategory() {
        return $this->belongsTo(ProductCategory::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
