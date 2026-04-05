<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_History extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'payslip_image',
        'payment_method',
        'order_code',
        'total_amount'
    ];
}
