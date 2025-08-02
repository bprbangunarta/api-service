<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientLog extends Model
{
    use SoftDeletes;

    protected $table = 'clients_logs';

    protected $fillable = [
        'client_id',
        'ip_address',
        'method',
        'url',
        'response_status',
        'response_body',
    ];

    public function client(): BelongsTo
    {
        // 'foreign_key', 'local_key'
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}
