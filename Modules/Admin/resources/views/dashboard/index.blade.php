<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Admin Dashboard</h1>
            <p class="text-gray-400">Welcome back, {{ auth()->user()->name }}. Here's what's happening with your platform today.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <i class="fas fa-cube text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-400">Total Units</h3>
                        <p class="text-2xl font-bold text-gray-200">{{ $totalUnits }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-400">Total Users</h3>
                        <p class="text-2xl font-bold text-gray-200">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100">
                        <i class="fas fa-shopping-cart text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-400">Total Rentals</h3>
                        <p class="text-2xl font-bold text-gray-200">{{ $totalRentals }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <i class="fas fa-exchange-alt text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-400">Active Rentals</h3>
                        <p class="text-2xl font-bold text-gray-200">{{ $activeRentals }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Rental Statistics Chart -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <h3 class="text-lg font-semibold text-gray-200 mb-4">Rental Statistics (Last 6 Months)</h3>
                <div class="h-64">
                    <canvas id="rentalStatsChart"></canvas>
                </div>
            </div>

            <!-- Unit Status -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <h3 class="text-lg font-semibold text-gray-200 mb-4">Unit Status Distribution</h3>
                <div class="h-64">
                    <canvas id="unitStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Rentals and Top Units -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Rentals -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-200">Recent Rentals</h3>
                    <a href="{{ route('admin.reports.rental-history') }}" class="text-sm text-primary-600 hover:text-primary-800">View All</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-dark-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">User</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Unit</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dark-200">
                            @forelse($recentRentals as $rental)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-200">{{ $rental->user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-200">{{ $rental->unit->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($rental->status === 'active') bg-yellow-100 text-yellow-800
                                        @elseif($rental->status === 'completed') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($rental->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-400">{{ $rental->created_at->format('M d, H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-sm text-gray-400 text-center">No recent rentals</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Rented Units -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-200">Top Rented Units</h3>
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
                                <div class="text-sm font-medium text-gray-200">{{ $unit->name }}</div>
                                <div class="text-sm text-gray-400">{{ $unit->rental_count }} rentals</div>
                            </div>
                            <div class="text-sm text-gray-400">{{ Str::limit($unit->description, 50) }}</div>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-400 text-center py-4">No rental data available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Rental Statistics Chart
        const rentalStatsCtx = document.getElementById('rentalStatsChart').getContext('2d');
        const rentalStatsChart = new Chart(rentalStatsCtx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($rentalStats as $stat)
                        'Month {{ $stat->month }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Rentals',
                    data: [
                        @foreach($rentalStats as $stat)
                            {{ $stat->count }},
                        @endforeach
                    ],
                    borderColor: '#ff4444',
                    backgroundColor: 'rgba(255, 68, 68, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Revenue (in thousands)',
                    data: [
                        @foreach($rentalStats as $stat)
                            {{ $stat->revenue / 1000 }},
                        @endforeach
                    ],
                    borderColor: '#60a5fa',
                    backgroundColor: 'rgba(96, 165, 250, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#d1d5db'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#9ca3af'
                        },
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#9ca3af'
                        },
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        }
                    }
                }
            }
        });

        // Unit Status Chart
        const unitStatusCtx = document.getElementById('unitStatusChart').getContext('2d');
        const unitStatusChart = new Chart(unitStatusCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($unitStatus as $status)
                        '{{ ucfirst($status->status) }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($unitStatus as $status)
                            {{ $status->count }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6'
                    ],
                    borderColor: '#0f1923',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#d1d5db',
                            padding: 15
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-admin::layouts.master>