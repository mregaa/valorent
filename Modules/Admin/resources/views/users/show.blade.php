<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">View User</h1>
            <p class="text-gray-600">Detailed information about the user</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6 border-b">
                    <div class="flex flex-col md:flex-row md:items-start justify-between">
                        <div class="flex items-start mb-4 md:mb-0">
                            <div class="h-20 w-20 rounded-full bg-primary-100 flex items-center justify-center">
                                <span class="text-primary-800 text-2xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-6">
                                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                                <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                                <div class="mt-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($user->role === 'admin') bg-purple-100 text-purple-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                    @if($user->email_verified_at)
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Verified
                                        </span>
                                    @else
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Unverified
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Full Name</h3>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ $user->name }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Email</h3>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ $user->email }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Role</h3>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{ ucfirst($user->role) }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Account Status</h3>
                            <p class="mt-1 text-lg font-medium text-gray-900">
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center text-green-600">
                                        <i class="fas fa-check-circle mr-1"></i> Verified
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-yellow-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Unverified
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Created At</h3>
                            <p class="mt-1 text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Updated At</h3>
                            <p class="mt-1 text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t bg-gray-50 flex justify-end">
                    @if($user->id !== auth()->id() || !$user->isAdmin())
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200 flex items-center" 
                            onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            <i class="fas fa-trash mr-2"></i> Delete User
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>