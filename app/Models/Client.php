<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable
{
    use HasRoles, SoftDeletes;

    protected $guard_name = 'api';
    protected $fillable = [
        'client_id',
        'client_name',
        'client_key',
    ];

    public function logs(): HasMany
    {
        // 'foreign_key', 'local_key'
        return $this->hasMany(ClientLog::class, 'client_id', 'client_id');
    }
}
