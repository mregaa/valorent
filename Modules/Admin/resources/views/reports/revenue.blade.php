<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Revenue Report</h1>
            <p class="text-gray-400">View revenue data by date range</p>
        </div>

        <!-- Filter Form -->
        <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-200 mb-4">Filter Report</h2>
            <form method="GET" action="{{ route('admin.reports.revenue') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-200 mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>Start Date
                        </label>
                        <input type="text" name="start_date" id="start_date" value="{{ $startDate }}" 
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="Select start date">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-200 mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i>End Date
                        </label>
                        <input type="text" name="end_date" id="end_date" value="{{ $endDate }}" 
                            class="w-full px-4 py-2 bg-dark-400 border border-dark-200 text-gray-200 rounded-lg focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="Select end date">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                            <i class="fas fa-chart-bar mr-2"></i>Generate Report
                        </button>
                        @if(request('start_date') || request('end_date'))
                        <a href="{{ route('admin.reports.revenue') }}" class="px-4 py-2 bg-dark-400 hover:bg-dark-200 text-gray-200 font-medium rounded-lg transition duration-200">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-400">Total Rentals</h3>
                        <p class="text-2xl font-bold text-gray-200">{{ $totalRentals }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <i class="fas fa-dollar-sign text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-400">Total Revenue</h3>
                        <p class="text-2xl font-bold text-gray-200">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-200 mb-4">Revenue Overview</h2>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Revenue Details Table -->
        <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-200">Daily Revenue Details</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-dark-200">
                    <thead class="bg-dark-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rental Count</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="bg-dark-50 divide-y divide-dark-200">
                        @forelse($revenueData as $data)
                        <tr class="hover:bg-dark-200 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">{{ $data->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $data->count }} rentals</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">Rp {{ number_format($data->revenue, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-chart-bar text-gray-300 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-200 mb-1">No revenue data</h3>
                                    <p class="text-gray-400">No revenue data available for the selected period</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Flatpickr for date inputs
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            theme: "dark",
            onChange: function(selectedDates, dateStr, instance) {
                // Update end_date minDate when start_date changes
                const endDatePicker = document.querySelector("#end_date")._flatpickr;
                if (endDatePicker) {
                    endDatePicker.set('minDate', dateStr);
                }
            }
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            theme: "dark",
            minDate: document.getElementById('start_date').value || null
        });
    </script>
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($revenueData as $data)
                        '{{ $data->date }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Revenue (Rp)',
                    data: [
                        @foreach($revenueData as $data)
                            {{ $data->revenue }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 68, 68, 0.8)',
                    borderColor: '#ff4444',
                    borderWidth: 1
                }, {
                    label: 'Rental Count',
                    data: [
                        @foreach($revenueData as $data)
                            {{ $data->count * 10000 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(96, 165, 250, 0.8)',
                    borderColor: '#60a5fa',
                    borderWidth: 1,
                    type: 'line',
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#d1d5db'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    if (context.dataset.label === 'Revenue (Rp)') {
                                        label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    } else {
                                        label += Math.round(context.parsed.y / 10000) + ' rentals';
                                    }
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        beginAtZero: true,
                        ticks: {
                            color: '#9ca3af',
                            callback: function(value) {
                                return 'Rp ' + (value / 1000).toFixed(0) + 'k';
                            }
                        },
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        beginAtZero: true,
                        ticks: {
                            color: '#9ca3af',
                            callback: function(value) {
                                return Math.round(value / 10000);
                            }
                        },
                        grid: {
                            drawOnChartArea: false,
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
    </script>
    @endpush
</x-admin::layouts.master>