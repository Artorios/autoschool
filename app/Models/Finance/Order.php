<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'payment_option',
        'amount',
        'number_contract'
    ];


}
