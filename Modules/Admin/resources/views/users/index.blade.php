<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Users Management</h1>
            <p class="text-gray-400">Manage platform users and administrators</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 overflow-hidden">
            <div class="p-6 border-b">
                <form method="GET" action="{{ route('admin.users.index') }}">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" class="bg-dark-400 border border-dark-200 text-gray-200 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 placeholder-gray-500" placeholder="Search users by name, email...">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @if(request('search'))
                                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                                    <i class="fas fa-times mr-2"></i> Clear
                                </a>
                            @endif
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-dark-400 hover:bg-dark-200 text-gray-200 font-medium rounded-lg transition duration-200">
                                <i class="fas fa-search mr-2"></i> Search
                            </button>
                            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-plus mr-2"></i> Add User
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-dark-200">
                    <thead class="bg-dark-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark-50 divide-y divide-dark-200">
                        @forelse($users as $user)
                        <tr class="hover:bg-dark-200 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                        <span class="text-primary-800 font-medium">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-200">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">
                                            @if($user->email_verified_at)
                                                <span class="inline-flex items-center text-xs">
                                                    <i class="fas fa-check-circle text-green-500 mr-1"></i> Verified
                                                </span>
                                            @else
                                                <span class="inline-flex items-center text-xs">
                                                    <i class="fas fa-exclamation-circle text-yellow-500 mr-1"></i> Unverified
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-200">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($user->role === 'admin') bg-purple-100 text-purple-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-600 hover:text-yellow-900 p-2 rounded-full hover:bg-yellow-50" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id() || !$user->isAdmin())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50" title="Delete" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @else
                                        <button class="text-gray-400 p-2 rounded-full" title="Cannot delete own admin account" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-users text-gray-300 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-200 mb-1">No users found</h3>
                                    <p class="text-gray-400">Get started by creating a new user</p>
                                    <div class="mt-4">
                                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                                            <i class="fas fa-plus mr-2"></i> Create User
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-dark-50 px-4 py-3 border-t border-dark-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-300">
                        Showing <span class="font-medium">{{ $users->firstItem() }}</span> 
                        to <span class="font-medium">{{ $users->lastItem() }}</span> 
                        of <span class="font-medium">{{ $users->total() }}</span> results
                    </div>
                    <div class="flex space-x-2">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>