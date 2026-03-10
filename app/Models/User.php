<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'store_id',
        'brand_id',
        'first_name',
        'last_name',
        'email',
        'role',
        'user_code',
        'is_active',
        'hired_at',
        'terminated_at',
        'termination_reason',
        'is_work_stoppage',
        'work_stoppage_start_date',
        'work_stoppage_end_date',
        'birth_date',
        'locale',
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
            'is_active' => 'boolean',
            'hired_at' => 'date',
            'terminated_at' => 'date',
            'is_work_stoppage' => 'boolean',
            'work_stoppage_start_date' => 'date',
            'work_stoppage_end_date' => 'date',
            'birth_date' => 'date',
        ];
    }

    /**
     * @return BelongsTo<Store, $this>
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * @return BelongsTo<Brand, $this>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function getFilamentName(): string
    {
        $name = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));

        if ($name !== '') {
            return $name;
        }

        if (!empty($this->email)) {
            return $this->email;
        }

        return 'User #' . $this->getKey();
    }
}
