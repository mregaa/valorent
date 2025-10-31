<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">Reports</h1>
            <p class="text-gray-400">Generate various reports for your platform</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Rental History Report -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <i class="fas fa-history text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-200">Rental History</h3>
                        <p class="text-gray-400 mt-1">View all rental transactions</p>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.reports.rental-history') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium">
                        View Report
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Unit Status Report -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <i class="fas fa-cube text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-200">Unit Status</h3>
                        <p class="text-gray-400 mt-1">View current status of all units</p>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.reports.unit-status') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium">
                        View Report
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- User Activity Report -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100">
                        <i class="fas fa-users text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-200">User Activity</h3>
                        <p class="text-gray-400 mt-1">View user rental activity</p>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.reports.user-activity') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium">
                        View Report
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Revenue Report -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-200">Revenue Report</h3>
                        <p class="text-gray-400 mt-1">View revenue by date range</p>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.reports.revenue') }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium">
                        View Report
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Export Data -->
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 p-6 hover:shadow-md transition-shadow md:col-span-2 lg:col-span-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-red-100">
                        <i class="fas fa-file-export text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-200">Export Data</h3>
                        <p class="text-gray-400 mt-1">Export rental history as CSV</p>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.reports.rental-history.export') }}" class="inline-flex items-center text-red-600 hover:text-red-800 font-medium">
                        Download CSV
                        <i class="fas fa-download ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>