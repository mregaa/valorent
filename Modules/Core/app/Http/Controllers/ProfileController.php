<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected ProfileRepositoryInterface $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function show(): View
    {
        $profile = $this->profileRepository->findByUserId(Auth::id());
        
        if (!$profile) {
            // If profile doesn't exist, redirect to create
            return redirect()->route('profiles.edit');
        }

        return view('core::profiles.show', compact('profile'));
    }

    public function edit(): View
    {
        $profile = $this->profileRepository->findByUserId(Auth::id());
        
        // If profile doesn't exist, create a new one for the form
        if (!$profile) {
            $profile = new \Modules\Core\App\Entities\Profile();
        }

        return view('core::profiles.edit', compact('profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user_id = Auth::id();
        
        // Handle avatar upload if provided
        $data = $request->except(['avatar']);
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $profile = $this->profileRepository->findByUserId($user_id);
        
        if ($profile) {
            // Update existing profile
            $this->profileRepository->update($user_id, $data);
        } else {
            // Create new profile
            $data['user_id'] = $user_id;
            $this->profileRepository->create($data);
        }

        return redirect()->route('profiles.show')
            ->with('success', 'Profile updated successfully.');
    }
}