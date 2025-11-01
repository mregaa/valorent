<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">View Category</h1>
            <p class="text-gray-400">Detailed information about the category</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 overflow-hidden">
                <div class="p-6 border-b border-dark-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-200">{{ $category->name }}</h2>
                            <p class="text-gray-400 mt-1">{{ $category->description ?? 'No description provided' }}</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-flex items-center px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Category Name</h3>
                            <p class="mt-1 text-lg font-medium text-gray-200">{{ $category->name }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Slug</h3>
                            <p class="mt-1 text-lg font-medium text-gray-200">{{ $category->slug }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg md:col-span-2">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Description</h3>
                            <p class="mt-1 text-gray-200">{{ $category->description ?? '-' }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Created At</h3>
                            <p class="mt-1 text-gray-200">{{ $category->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Updated At</h3>
                            <p class="mt-1 text-gray-200">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-dark-200 bg-dark-400 flex justify-end">
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200 flex items-center" 
                            onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                            <i class="fas fa-trash mr-2"></i> Delete Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>