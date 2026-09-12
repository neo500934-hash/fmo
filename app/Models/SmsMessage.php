<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Get the customer this message is associated with.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
