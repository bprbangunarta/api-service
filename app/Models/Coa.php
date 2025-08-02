<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coa extends Model
{
    protected $fillable = [
        'code',
        'name',
        'balance',
        'office_code',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_code', 'code');
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'office', 'office_code');
    }
}
