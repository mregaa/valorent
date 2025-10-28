<?php

namespace Modules\Core\App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Relationship: Category has many Units (many-to-many)
     */
    public function units(): BelongsToMany
    {
        return $this->belongsToMany(
            \Modules\Catalog\App\Entities\Unit::class,
            'unit_category'
        );
    }
}
