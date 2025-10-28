<?php

namespace Modules\Core\App\Repositories;

use Modules\Core\App\Entities\Profile;

interface ProfileRepositoryInterface
{
    public function findByUserId(int $userId): ?Profile;
    
    public function create(array $data): Profile;
    
    public function update(int $userId, array $data): bool;
    
    public function delete(int $userId): bool;
}
