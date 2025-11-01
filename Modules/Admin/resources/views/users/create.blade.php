<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Create New User</h1>
            <p class="text-gray-400">Add a new user or administrator to the platform</p>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            @error('password')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                        <select name="role" id="role" required
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }} class="bg-dark-400 text-gray-200">User</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }} class="bg-dark-400 text-gray-200">Admin</option>
                        </select>
                        @error('role')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-dark-200">
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200 flex items-center">
                            <i class="fas fa-user-plus mr-2"></i> Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin::layouts.master>