<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Create New Unit</h1>
            <p class="text-gray-400">Add a new game account to the catalog</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <form action="{{ route('admin.units.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-300 mb-2">Unit Code</label>
                            <input type="text" name="code" id="code" value="{{ old('code') }}" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            @error('code')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Unit Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            @error('name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="rank" class="block text-sm font-medium text-gray-300 mb-2">Rank</label>
                            <input type="text" name="rank" id="rank" value="{{ old('rank') }}" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            @error('rank')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-300 mb-2">Level</label>
                            <input type="number" name="level" id="level" value="{{ old('level', 1) }}" min="1" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            @error('level')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price_per_day" class="block text-sm font-medium text-gray-300 mb-2">Price per Day (Rp)</label>
                            <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day') }}" min="0" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            @error('price_per_day')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                            <select name="status" id="status" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                                <option value="available" {{ old('status') === 'available' ? 'selected' : '' }} class="bg-dark-400 text-gray-200">Available</option>
                                <option value="rented" {{ old('status') === 'rented' ? 'selected' : '' }} class="bg-dark-400 text-gray-200">Rented</option>
                                <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }} class="bg-dark-400 text-gray-200">Maintenance</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Image</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            <p class="mt-1 text-sm text-gray-400">Max file size: 2MB. Formats: jpeg, png, jpg, gif</p>
                            @error('image')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Categories</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            @foreach($categories as $category)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        class="bg-dark-400 rounded border-dark-200 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-300">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('categories')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-dark-200">
                        <a href="{{ route('admin.units.index') }}" class="px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i> Create Unit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin::layouts.master>