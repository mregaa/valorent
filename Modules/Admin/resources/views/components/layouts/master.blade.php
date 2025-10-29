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
                            primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a"}
                        }
                    }
                }
            }
        </script>
    </head>

    <body class="bg-gray-50 min-h-screen">
        <!-- Sidebar -->
        <div class="flex">
            <div class="fixed inset-y-0 left-0 w-64 bg-white border-r shadow-md z-10">
                <div class="p-6 border-b">
                    <h1 class="text-2xl font-bold text-primary-600">Valorent Admin</h1>
                </div>
                <nav class="p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-primary-600 font-medium' : 'hover:bg-gray-100' }} transition">
                                <i class="fas fa-tachometer-alt text-primary-600"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-primary-600 font-medium' : 'hover:bg-gray-100' }} transition">
                                <i class="fas fa-tags text-primary-600"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.units.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.units.*') ? 'bg-blue-50 text-primary-600 font-medium' : 'hover:bg-gray-100' }} transition">
                                <i class="fas fa-cube text-primary-600"></i>
                                <span>Units</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-primary-600 font-medium' : 'hover:bg-gray-100' }} transition">
                                <i class="fas fa-users text-primary-600"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-blue-50 text-primary-600 font-medium' : 'hover:bg-gray-100' }} transition">
                                <i class="fas fa-chart-bar text-primary-600"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rental.index') }}" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->routeIs('rental.index') ? 'bg-blue-50 text-primary-600 font-medium' : 'hover:bg-gray-100' }} transition">
                                <i class="fas fa-clipboard-list text-primary-600"></i>
                                <span>Rentals</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Header -->
                <header class="bg-white shadow-sm">
                    <div class="flex justify-between items-center p-4 border-b">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Admin Panel')</h2>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-primary-500 flex items-center justify-center text-white font-bold">
                                    {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                                </div>
                                <span class="text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Content Area -->
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
