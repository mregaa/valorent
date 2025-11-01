<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Edit Category</h1>
            <p class="text-gray-400">Update category information</p>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-dark-200">
                        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i> Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin::layouts.master>