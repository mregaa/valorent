<?php

namespace Modules\Core\Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Core\App\Entities\Profile;
use Modules\Core\App\Repositories\ProfileRepositoryInterface;
use Tests\TestCase;

class ProfileRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected ProfileRepositoryInterface $profileRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->profileRepository = $this->app->make(ProfileRepositoryInterface::class);
    }

    public function test_it_can_create_profile(): void
    {
        $user = User::factory()->create();
        
        $data = [
            'user_id' => $user->id,
            'phone' => '+6281234567890',
            'address' => 'Jl. Example Street No. 123',
            'birth_date' => '1995-01-01',
            'avatar' => 'avatar.jpg'
        ];

        $profile = $this->profileRepository->create($data);

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($user->id, $profile->user_id);
        $this->assertEquals('+6281234567890', $profile->phone);
    }

    public function test_it_can_find_profile_by_user_id(): void
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id
        ]);

        $foundProfile = $this->profileRepository->findByUserId($user->id);

        $this->assertInstanceOf(Profile::class, $foundProfile);
        $this->assertEquals($profile->user_id, $foundProfile->user_id);
    }

    public function test_it_returns_null_when_profile_not_found_by_user_id(): void
    {
        $profile = $this->profileRepository->findByUserId(999);

        $this->assertNull($profile);
    }

    public function test_it_can_update_profile(): void
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'phone' => 'Old Phone',
            'address' => 'Old Address'
        ]);

        $updated = $this->profileRepository->update($user->id, [
            'phone' => 'New Phone',
            'address' => 'New Address'
        ]);

        $this->assertTrue($updated);

        $updatedProfile = Profile::where('user_id', $user->id)->first();
        $this->assertEquals('New Phone', $updatedProfile->phone);
        $this->assertEquals('New Address', $updatedProfile->address);
    }

    public function test_it_can_delete_profile(): void
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id
        ]);

        $deleted = $this->profileRepository->delete($user->id);

        $this->assertTrue($deleted);
        $this->assertNull(Profile::where('user_id', $user->id)->first());
    }
}