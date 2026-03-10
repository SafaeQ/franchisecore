<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'franchise_number',
        'primary_color',
        'secondary_color',
        'logo',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'is_active',
        'project_type',
        'start_date',
        'expected_opening_date',
        'core_store_id',
        'store_employee_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'expected_opening_date' => 'date',
    ];

    /**
     * @return BelongsTo<Brand, $this>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return BelongsTo<Store, $this>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'core_store_id');
    }

    /**
     * @return HasMany<Store, $this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(Store::class, 'core_store_id');
    }
}
