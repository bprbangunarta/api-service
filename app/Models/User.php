<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'office',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getEmailBadgeAttribute(): string
    {
        if ($this->deleted_at) {
            return '<span class="badge bg-secondary me-1" title="Tidak Aktif"></span>';
        } elseif (!$this->email_verified_at) {
            return '<span class="badge bg-warning me-1" title="Belum Terverifikasi"></span>';
        } else {
            return '<span class="badge bg-success me-1" title="Terverifikasi"></span>';
        }
    }

    public function log(): HasMany
    {
        return $this->hasMany(UserLog::class, 'user_id');
    }

    public function collector(): HasOne
    {
        return $this->hasOne(Collector::class, 'user_id', 'id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office', 'code');
    }

    public function coa(): BelongsTo
    {
        return $this->belongsTo(Coa::class, 'office', 'office_code');
    }
}
