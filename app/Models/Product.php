<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'inventory_id',
        'discount_id',
        'name',
        'desc',
        'SKU',
        'price',
    ];

    public function items()
    {
        return $this->hasOne(CartItem::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategrory::class);
    }

    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class);
    }
    
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
