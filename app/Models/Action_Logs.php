<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action_Logs extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'action'
    ];
}
