<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLog extends Model
{
    use SoftDeletes;

    protected $table = 'users_logs';

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'url',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
