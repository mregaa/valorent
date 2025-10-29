<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Categories Management</h1>
            <p class="text-gray-600 mt-2">Manage your game account categories</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="p-6 border-b">
                <form method="GET" action="{{ route('admin.categories.index') }}">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5" placeholder="Search categories by name, slug...">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @if(request('search'))
                                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fas fa-times mr-2"></i> Clear
                                </a>
                            @endif
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-search mr-2"></i> Search
                            </button>
                            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-plus mr-2"></i> Add Category
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-md bg-primary-100 flex items-center justify-center">
                                        <i class="fas fa-tags text-primary-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $category->slug }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $category->description ?? '-' }}">{{ $category->description ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.categories.show', $category->id) }}" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-yellow-600 hover:text-yellow-900 p-2 rounded-full hover:bg-yellow-50" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50" title="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-tags text-gray-300 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">No categories found</h3>
                                    <p class="text-gray-500">Get started by creating a new category</p>
                                    <div class="mt-4">
                                        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                                            <i class="fas fa-plus mr-2"></i> Create Category
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing <span class="font-medium">{{ $categories->firstItem() }}</span> 
                        to <span class="font-medium">{{ $categories->lastItem() }}</span> 
                        of <span class="font-medium">{{ $categories->total() }}</span> results
                    </div>
                    <div class="flex space-x-2">
                        {{ $categories->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>