<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary-500">Rentals Management</h1>
                <p class="text-gray-400">Manage all rental transactions</p>
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
            <div class="p-6 border-b border-dark-200">
                <form method="GET" action="{{ route('rental.index') }}">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                    <input type="text" name="search" value="{{ request('search') }}" class="bg-dark-400 border border-dark-200 text-gray-200 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 placeholder-gray-500" placeholder="Search by rental code, user, unit...">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @if(request('search'))
                                    <a href="{{ route('rental.index') }}" class="inline-flex items-center px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                                    <i class="fas fa-times mr-2"></i> Clear
                                </a>
                            @endif
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-dark-400 hover:bg-dark-200 text-gray-200 font-medium rounded-lg transition duration-200">
                                <i class="fas fa-search mr-2"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-dark-200">
                        <thead class="bg-dark-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rental Code</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Unit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rental Period</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark-50 divide-y divide-dark-200">
                        @forelse($rentals as $rental)
                        <tr class="hover:bg-dark-200 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-200">{{ $rental->rental_code }}</div>
                                <div class="text-sm text-gray-400">{{ $rental->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                        <i class="fas fa-user text-primary-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-200">{{ $rental->user->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $rental->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-md overflow-hidden bg-primary-100 flex items-center justify-center">
                                        @if($rental->unit->image_url)
                                            <img src="{{ $rental->unit->image_url }}" alt="{{ $rental->unit->name }}" class="h-full w-full object-cover" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-gamepad text-primary-600\'></i>';">
                                        @else
                                            <i class="fas fa-gamepad text-primary-600"></i>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-200">{{ $rental->unit->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $rental->unit->code }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-200">{{ $rental->rental_date->format('M d, Y') }}</div>
                                <div class="text-sm text-gray-400">to {{ $rental->due_date->format('M d, Y') }}</div>
                                @if($rental->return_date)
                                    <div class="text-sm text-green-600">Returned: {{ $rental->return_date->format('M d, Y') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-200">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</div>
                                @if($rental->fine > 0)
                                    <div class="text-sm text-red-600">Fine: Rp {{ number_format($rental->fine, 0, ',', '.') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($rental->status === 'active') bg-yellow-100 text-yellow-800
                                    @elseif($rental->status === 'returned') bg-green-100 text-green-800
                                    @elseif($rental->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($rental->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('rental.show', $rental->id) }}" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-clipboard-list text-gray-300 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-200 mb-1">No rentals found</h3>
                                    <p class="text-gray-400">No rental transactions have been recorded yet</p>
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
                        Showing <span class="font-medium">{{ $rentals->firstItem() }}</span> 
                        to <span class="font-medium">{{ $rentals->lastItem() }}</span> 
                        of <span class="font-medium">{{ $rentals->total() }}</span> results
                    </div>
                    <div class="flex space-x-2">
                        {{ $rentals->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>
