<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Admin Panel')</title>

        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="keywords" content="{{ $keywords ?? '' }}">
        <meta name="author" content="{{ $author ?? '' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {"50":"#fee2e2","100":"#fecaca","200":"#fca5a5","300":"#f87171","400":"#ef4444","500":"#ff4444","600":"#dc2626","700":"#b91c1c","800":"#991b1b","900":"#7f1d1d"},
                            dark: {"50":"#1a2332","100":"#151d2a","200":"#121821","300":"#0f1923","400":"#0d1520","500":"#0a111a","600":"#080d15","700":"#060a10","800":"#04070b","900":"#020406"}
                        }
                    }
                }
            }
        </script>
    </head>

    <body class="bg-dark-300 min-h-screen">
        <!-- Sidebar -->
        <div class="flex">
            <div class="fixed inset-y-0 left-0 w-64 bg-dark-500 border-r border-dark-200 shadow-md z-10 flex flex-col">
                <div class="p-6 border-b border-dark-200">
                    <h1 class="text-2xl font-bold text-primary-500">Valorent Admin</h1>
                </div>
                <nav class="p-4 flex-1 overflow-y-auto">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary-900 text-primary-500 font-medium' : 'text-gray-300 hover:bg-dark-200' }} transition">
                                <i class="fas fa-tachometer-alt text-primary-600"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-primary-900 text-primary-500 font-medium' : 'text-gray-300 hover:bg-dark-200' }} transition">
                                <i class="fas fa-tags text-primary-600"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.units.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.units.*') ? 'bg-primary-900 text-primary-500 font-medium' : 'text-gray-300 hover:bg-dark-200' }} transition">
                                <i class="fas fa-cube text-primary-600"></i>
                                <span>Units</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-primary-900 text-primary-500 font-medium' : 'text-gray-300 hover:bg-dark-200' }} transition">
                                <i class="fas fa-users text-primary-600"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-primary-900 text-primary-500 font-medium' : 'text-gray-300 hover:bg-dark-200' }} transition">
                                <i class="fas fa-chart-bar text-primary-600"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rental.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('rental.index') ? 'bg-primary-900 text-primary-500 font-medium' : 'text-gray-300 hover:bg-dark-200' }} transition">
                                <i class="fas fa-clipboard-list text-primary-600"></i>
                                <span>Rentals</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- User Info & Logout -->
                <div class="p-4 border-t border-dark-200">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-200 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Content -->
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
