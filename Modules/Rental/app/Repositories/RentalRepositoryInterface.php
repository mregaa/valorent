<?php

namespace Modules\Rental\App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Rental\App\Entities\Rental;

interface RentalRepositoryInterface
{
    public function all(): Collection;
    
    public function findById(int $id): ?Rental;
    
    public function findByCode(string $code): ?Rental;
    
    public function getActiveRentals(): Collection;
    
    public function getOverdueRentals(): Collection;
    
    public function getUserRentals(int $userId): Collection;
    
    public function getUserActiveRentals(int $userId): Collection;
    
    public function countUserActiveRentals(int $userId): int;
    
    public function create(array $data): Rental;
    
    public function update(int $id, array $data): bool;
    
    public function returnRental(int $id): bool;
    
    public function search(string $query);

    public function paginate(int $perPage = 15);
}
