@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Profile</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('phone')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
                    <textarea name="address" id="address" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('address', $profile->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="birth_date" class="block text-gray-700 text-sm font-bold mb-2">Birth Date:</label>
                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $profile->birth_date) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('birth_date')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="avatar" class="block text-gray-700 text-sm font-bold mb-2">Avatar:</label>
                    <input type="file" name="avatar" id="avatar"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('avatar')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                    
                    @if($profile->avatar)
                        <div class="mt-2">
                            <p class="text-gray-700">Current Avatar:</p>
                            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover mt-1">
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Profile
                    </button>
                    <a href="{{ route('profiles.show') }}" class="text-gray-600 hover:text-gray-900">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection