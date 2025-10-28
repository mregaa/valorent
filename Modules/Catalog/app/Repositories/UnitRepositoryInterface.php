<?php

namespace Modules\Catalog\App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Catalog\App\Entities\Unit;

interface UnitRepositoryInterface
{
    public function all(): Collection;
    
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    public function findById(int $id): ?Unit;
    
    public function findByCode(string $code): ?Unit;
    
    public function searchByName(string $name): Collection;
    
    public function getAvailableUnits(): Collection;
    
    public function filterByCategory(int $categoryId): Collection;
    
    public function create(array $data): Unit;
    
    public function update(int $id, array $data): bool;
    
    public function delete(int $id): bool;
    
    public function attachCategories(int $unitId, array $categoryIds): void;
    
    public function syncCategories(int $unitId, array $categoryIds): void;
}
