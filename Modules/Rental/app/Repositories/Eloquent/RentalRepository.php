<?php

namespace Modules\Rental\App\Repositories\Eloquent;

use Modules\Rental\App\Repositories\RentalRepositoryInterface;
use Modules\Rental\App\Entities\Rental;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class RentalRepository implements RentalRepositoryInterface
{
    protected Rental $model;

    public function __construct(Rental $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->with(['user', 'unit'])->get();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function search(string $query)
    {
        return $this->model->with(['user', 'unit'])
            ->where(function($q) use ($query) {
                $q->where('rental_code', 'LIKE', "%{$query}%")
                  ->orWhereHas('user', function($q) use ($query) {
                      $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%");
                  })
                  ->orWhereHas('unit', function($q) use ($query) {
                      $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('code', 'LIKE', "%{$query}%");
                  });
            })
            ->orderBy('created_at', 'desc');
    }

    public function findById(int $id): ?Rental
    {
        return $this->model->with(['user', 'unit'])->find($id);
    }

    public function findByCode(string $code): ?Rental
    {
        return $this->model->with(['user', 'unit'])
            ->where('rental_code', $code)
            ->first();
    }

    public function getActiveRentals(): Collection
    {
        return $this->model->with(['user', 'unit'])
            ->where('status', 'active')
            ->get();
    }

    public function getOverdueRentals(): Collection
    {
        return $this->model->with(['user', 'unit'])
            ->where('status', 'active')
            ->where('due_date', '<', Carbon::now())
            ->get();
    }

    public function getUserRentals(int $userId): Collection
    {
        return $this->model->with(['unit'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUserActiveRentals(int $userId): Collection
    {
        return $this->model->with(['unit'])
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->get();
    }

    public function countUserActiveRentals(int $userId): int
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->count();
    }

    public function create(array $data): Rental
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $rental = $this->findById($id);
        
        if (!$rental) {
            return false;
        }

        return $rental->update($data);
    }

    public function returnRental(int $id): bool
    {
        $rental = $this->findById($id);
        
        if (!$rental) {
            return false;
        }

        // Calculate fine if overdue
        $fine = 0;
        if ($rental->isOverdue()) {
            $fine = $rental->calculateFine();
        }

        // Update rental status
        $rental->update([
            'return_date' => Carbon::now(),
            'status' => 'returned',
            'fine' => $fine,
        ]);

        // Update unit status to available
        $rental->unit->update([
            'status' => 'available',
        ]);

        return true;
    }
}
