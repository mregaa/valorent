<?php

namespace Modules\Rental\App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Modules\Catalog\App\Entities\Unit;
use Carbon\Carbon;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_code',
        'user_id',
        'unit_id',
        'rental_date',
        'due_date',
        'return_date',
        'total_price',
        'fine',
        'status',
    ];

    protected $casts = [
        'rental_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'total_price' => 'decimal:2',
        'fine' => 'decimal:2',
    ];

    /**
     * Check if rental is overdue
     */
    public function isOverdue(): bool
    {
        if ($this->status === 'returned') {
            return false;
        }

        return Carbon::now()->greaterThan($this->due_date);
    }

    /**
     * Calculate fine for overdue rental (10% per hari dari harga sewa)
     */
    public function calculateFine(): float
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        $daysOverdue = Carbon::now()->diffInDays($this->due_date);
        $finePerDay = $this->unit->price_per_day * 0.1; // 10% dari harga per hari
        
        return $daysOverdue * $finePerDay;
    }

    /**
     * Relationship: Rental belongs to User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Rental belongs to Unit
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
