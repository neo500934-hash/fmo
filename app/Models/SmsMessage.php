<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    protected $fillable = [
        'direction',
        'from_number',
        'to_number',
        'body',
        'provider_sid',
        'status',
        'customer_id',
    ];
}
