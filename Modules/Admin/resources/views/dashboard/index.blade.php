<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
            <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}. Here's what's happening with your platform today.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <i class="fas fa-cube text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Units</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalUnits }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100">
                        <i class="fas fa-shopping-cart text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Rentals</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalRentals }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <i class="fas fa-exchange-alt text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Active Rentals</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeRentals }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Rental Statistics Chart -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Rental Statistics (Last 6 Months)</h3>
                <div class="h-64 flex items-center justify-center">
                    <!-- Chart placeholder - in a real application you would use Chart.js or similar -->
                    <div class="text-center">
                        <i class="fas fa-chart-line text-gray-300 text-4xl mb-2"></i>
                        <p class="text-gray-500">Rental Statistics Chart</p>
                        <p class="text-sm text-gray-400 mt-2">
                            @foreach($rentalStats as $stat)
                                Month {{ $stat->month }}: {{ $stat->count }} rentals, Rp {{ number_format($stat->revenue, 0, ',', '.') }}<br>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>

            <!-- Unit Status -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Unit Status Distribution</h3>
                <div class="h-64 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-chart-pie text-gray-300 text-4xl mb-2"></i>
                        <p class="text-gray-500">Unit Status Distribution</p>
                        <p class="text-sm text-gray-400 mt-2">
                            @foreach($unitStatus as $status)
                                {{ ucfirst($status->status) }}: {{ $status->count }} units<br>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Rentals and Top Units -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Rentals -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Rentals</h3>
                    <a href="{{ route('admin.reports.rental-history') }}" class="text-sm text-primary-600 hover:text-primary-800">View All</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentRentals as $rental)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $rental->user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $rental->unit->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($rental->status === 'active') bg-yellow-100 text-yellow-800
                                        @elseif($rental->status === 'completed') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($rental->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $rental->created_at->format('M d, H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-sm text-gray-500 text-center">No recent rentals</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Rented Units -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Top Rented Units</h3>
                    <a href="{{ route('admin.reports.unit-status') }}" class="text-sm text-primary-600 hover:text-primary-800">View All</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($topRentedUnits as $unit)
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-md bg-primary-100 flex items-center justify-center">
                            <i class="fas fa-gamepad text-primary-600"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex justify-between">
                                <div class="text-sm font-medium text-gray-900">{{ $unit->name }}</div>
                                <div class="text-sm text-gray-500">{{ $unit->rental_count }} rentals</div>
                            </div>
                            <div class="text-sm text-gray-500">{{ Str::limit($unit->description, 50) }}</div>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500 text-center py-4">No rental data available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>