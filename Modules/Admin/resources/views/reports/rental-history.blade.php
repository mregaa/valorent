<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Rental History Report</h1>
            <p class="text-gray-400">View all rental transactions on the platform</p>
        </div>

        <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 overflow-hidden">
            <div class="p-6 border-b">
                <form method="GET" action="{{ route('admin.reports.rental-history') }}">
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
                                <a href="{{ route('admin.reports.rental-history') }}" class="inline-flex items-center px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                                    <i class="fas fa-times mr-2"></i> Clear
                                </a>
                            @endif
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-dark-400 hover:bg-dark-200 text-gray-200 font-medium rounded-lg transition duration-200">
                                <i class="fas fa-search mr-2"></i> Search
                            </button>
                            <a href="{{ route('admin.reports.rental-history.export') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-download mr-2"></i> Export CSV
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-dark-200">
                    <thead class="bg-dark-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Unit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Dates</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark-50 divide-y divide-dark-200">
                        @forelse($rentals as $rental)
                        <tr class="hover:bg-dark-200 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">#{{ $rental->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-200">{{ $rental->user->name }}</div>
                                <div class="text-sm text-gray-400">{{ $rental->user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-200">{{ $rental->unit->name }}</div>
                                <div class="text-sm text-gray-400">{{ $rental->unit->code }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-200">{{ $rental->rental_date ? $rental->rental_date->format('M d, Y') : '-' }}</div>
                                <div class="text-sm text-gray-400">to {{ $rental->due_date ? $rental->due_date->format('M d, Y') : '-' }}</div>
                                @if($rental->return_date)
                                    <div class="text-sm text-green-600">Returned: {{ $rental->return_date->format('M d, Y') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">
                                Rp {{ number_format($rental->total_price, 0, ',', '.') }}
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
                                <a href="{{ route('rental.show', $rental->id) }}" class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-history text-gray-300 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-200 mb-1">No rental history found</h3>
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