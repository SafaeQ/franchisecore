<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'tag',
        'logo',
        'favicon',
        'design_config',
        'theme_id',
        'links',
        'sms_phone_number',
        'email_from_address',
        'email_from_name',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'design_config' => 'array',
        'links' => 'array',
    ];

    /**
     * @return HasMany<Store, $this>
     */
    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }

    /**
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return BelongsTo<Theme, $this>
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    protected function tag(): Attribute
    {
        return Attribute::make(
            set: fn (string $value): string => strtoupper($value),
        );
    }
}
