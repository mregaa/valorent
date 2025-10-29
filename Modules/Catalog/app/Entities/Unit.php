<?php

namespace Modules\Catalog\App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Core\App\Entities\Category;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'rank',
        'level',
        'price_per_day',
        'image',
        'status',
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
        'level' => 'integer',
    ];

    /**
     * Get the image URL attribute
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        // If image path already starts with http/https, return as is
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Return asset URL
        return asset($this->image);
    }

    /**
     * Check if unit is available for rent
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    /**
     * Check if unit is currently rented
     */
    public function isRented(): bool
    {
        return $this->status === 'rented';
    }

    /**
     * Relationship: Unit has many Categories (many-to-many)
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'unit_category'
        );
    }

    /**
     * Relationship: Unit has many Rentals
     */
    public function rentals(): HasMany
    {
        return $this->hasMany(\Modules\Rental\App\Entities\Rental::class);
    }

    /**
     * Get active rental for this unit
     */
    public function activeRental(): HasOne
    {
        return $this->hasOne(\Modules\Rental\App\Entities\Rental::class)
            ->where('status', 'active');
    }
}
