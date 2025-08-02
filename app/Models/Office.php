<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Office extends Model
{
    protected $fillable = [
        'code',
        'name',
        'address',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'office', 'code');
    }

    public function coa(): HasMany
    {
        return $this->hasMany(Coa::class, 'office_code', 'code');
    }
}
