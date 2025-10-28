<?php

namespace Modules\Core\App\Repositories\Eloquent;

use Modules\Core\App\Entities\Profile;
use Modules\Core\App\Repositories\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function findByUserId(int $userId): ?Profile
    {
        return Profile::where('user_id', $userId)->first();
    }

    public function create(array $data): Profile
    {
        return Profile::create($data);
    }

    public function update(int $userId, array $data): bool
    {
        $profile = Profile::where('user_id', $userId)->first();
        if ($profile) {
            return $profile->update($data);
        }
        return false;
    }

    public function delete(int $userId): bool
    {
        $profile = Profile::where('user_id', $userId)->first();
        if ($profile) {
            return $profile->delete();
        }
        return false;
    }
}