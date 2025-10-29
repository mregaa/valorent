<?php

namespace Modules\Catalog\App\Repositories\Eloquent;

use Modules\Catalog\App\Repositories\UnitRepositoryInterface;
use Modules\Catalog\App\Entities\Unit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UnitRepository implements UnitRepositoryInterface
{
    protected Unit $model;

    public function __construct(Unit $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->with('categories')->get();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Unit
    {
        return $this->model->with('categories')->find($id);
    }

    public function findByCode(string $code): ?Unit
    {
        return $this->model->with('categories')
            ->where('code', $code)
            ->first();
    }

    public function searchByName(string $name): Collection
    {
        return $this->model->with('categories')
            ->where('name', 'LIKE', "%{$name}%")
            ->get();
    }

    public function search(string $query)
    {
        return $this->model->with('categories')
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('code', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('rank', 'LIKE', "%{$query}%");
            })
            ->orderBy('created_at', 'desc');
    }

    public function getAvailableUnits(): Collection
    {
        return $this->model->with('categories')
            ->where('status', 'available')
            ->get();
    }

    public function filterByCategory(int $categoryId): Collection
    {
        return $this->model->with('categories')
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })
            ->get();
    }

    public function create(array $data): Unit
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $unit = $this->findById($id);
        
        if (!$unit) {
            return false;
        }

        return $unit->update($data);
    }

    public function delete(int $id): bool
    {
        $unit = $this->findById($id);
        
        if (!$unit) {
            return false;
        }

        return $unit->delete();
    }

    public function attachCategories(int $unitId, array $categoryIds): void
    {
        $unit = $this->findById($unitId);
        
        if ($unit) {
            $unit->categories()->attach($categoryIds);
        }
    }

    public function syncCategories(int $unitId, array $categoryIds): void
    {
        $unit = $this->findById($unitId);
        
        if ($unit) {
            $unit->categories()->sync($categoryIds);
        }
    }
}
