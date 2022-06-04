<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'total',
    ];

    public function orderitem()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentdetail()
    {
        return $this->belongsTo(PaymentDetails::class);
    }

}
