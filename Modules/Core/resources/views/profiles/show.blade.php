@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
            <a href="{{ route('profiles.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Profile
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="flex-shrink-0">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-blue-200">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center border-4 border-blue-200">
                            <span class="text-gray-500 text-4xl">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                
                <div class="flex-grow">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-1">Name</h3>
                            <p class="text-gray-900">{{ auth()->user()->name ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-1">Email</h3>
                            <p class="text-gray-900">{{ auth()->user()->email ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-1">Phone</h3>
                            <p class="text-gray-900">{{ $profile->phone ?? 'Not provided' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-1">Address</h3>
                            <p class="text-gray-900">{{ $profile->address ?? 'Not provided' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-1">Birth Date</h3>
                            <p class="text-gray-900">{{ $profile->birth_date ? $profile->birth_date->format('M d, Y') : 'Not provided' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-1">Member Since</h3>
                            <p class="text-gray-900">{{ auth()->user()->created_at->format('M d, Y') ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection