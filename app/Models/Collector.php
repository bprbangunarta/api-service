<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collector extends Model
{
    // use SoftDeletes;

    protected $table    = 'collectors';
    protected $fillable = [
        'user_id',
        'person',
        'marketing',
        'surveyor',
        'funding',
        'credit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function savings(): HasMany
    {
        return $this->hasMany(Saving::class, 'collector_code', 'funding');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'collector_code', 'collector_code');
    }
}
