<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saving extends Model
{
    protected $fillable = [
        'rekening',
        'name',
        'address',
        'balance',
        'collector_code',
    ];

    public function collector(): BelongsTo
    {
        return $this->belongsTo(Collector::class, 'collector_code', 'funding');
    }
}
