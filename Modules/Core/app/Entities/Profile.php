<?php

namespace Modules\Core\App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'birth_date',
        'avatar',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Relationship: Profile belongs to User (one-to-one)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
