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

        // ✅ Perbaikan: Hitung hari keterlambatan dengan benar
        $daysOverdue = $this->due_date->diffInDays(Carbon::now());
        
        // Pastikan unit relationship sudah di-load
        if (!$this->relationLoaded('unit')) {
            $this->load('unit');
        }
        
        $finePerDay = $this->unit->price_per_day * 0.1; // 10% dari harga per hari
        
        return $daysOverdue * $finePerDay;
    }

    /**
     * Get current fine (from DB or calculated)
     * Gunakan ini untuk menampilkan denda di view
     */
    public function getCurrentFine(): float
    {
        // Jika sudah returned, gunakan fine dari database
        if ($this->status === 'returned') {
            return (float) $this->fine;
        }
        
        // Jika masih active, hitung real-time
        return $this->calculateFine();
    }

    /**
     * Get total amount to pay (price + fine)
     */
    public function getTotalAmount(): float
    {
        return $this->total_price + $this->getCurrentFine();
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
