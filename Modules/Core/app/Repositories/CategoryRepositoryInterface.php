<?php

namespace Modules\Core\App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\App\Entities\Category;

interface CategoryRepositoryInterface
{
    public function all(): Collection;
    
    public function findById(int $id): ?Category;
    
    public function findBySlug(string $slug): ?Category;
    
    public function create(array $data): Category;
    
    public function update(int $id, array $data): bool;
    
    public function delete(int $id): bool;
}
