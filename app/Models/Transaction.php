<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'number',
        'office',
        'collector_code',
        'type',
        'account',
        'source',
        'destination',
        'amount',
        'previous_balance',
        'ending_balance',
        'description',
    ];

    public function collector(): BelongsTo
    {
        return $this->belongsTo(Collector::class, 'collector_code', 'collector_code');
    }
}
