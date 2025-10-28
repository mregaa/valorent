<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Revenue Report</h1>
            <p class="text-gray-600">View revenue data by date range</p>
        </div>

        <!-- Filter Form -->
        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Report</h2>
            <form method="GET" action="{{ route('admin.reports.revenue') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                            Generate Report
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Rentals</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalRentals }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <i class="fas fa-dollar-sign text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Revenue</h3>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Revenue Overview</h2>
            <div class="h-64 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-chart-line text-gray-300 text-4xl mb-2"></i>
                    <p class="text-gray-500">Revenue Chart</p>
                    <p class="text-sm text-gray-400 mt-2">
                        @forelse($revenueData as $data)
                            {{ $data->date }}: {{ $data->count }} rentals, Rp {{ number_format($data->revenue, 0, ',', '.') }}<br>
                        @empty
                            No revenue data available for the selected period
                        @endforelse
                    </p>
                </div>
            </div>
        </div>

        <!-- Revenue Details Table -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Daily Revenue Details</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rental Count</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($revenueData as $data)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $data->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->count }} rentals</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($data->revenue, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-chart-bar text-gray-300 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">No revenue data</h3>
                                    <p class="text-gray-500">No revenue data available for the selected period</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin::layouts.master>