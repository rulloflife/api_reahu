<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_address';

    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
