<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LeaveManager') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="flex h-screen bg-gray-50">
            <!-- Sidebar -->
            <div class="w-64 bg-white border-r border-gray-200 shadow-sm fixed h-screen overflow-y-auto z-50">
                <!-- Logo -->
                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white text-lg">LM</div>
                        <div>
                            <p class="font-bold text-gray-900">LeaveManager</p>
                            <p class="text-xs text-gray-500">Management System</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="px-4 py-8">
                    <!-- Main Section -->
                    <div class="mb-8">
                        <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Main</h3>
                        <div class="space-y-1">
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                                </svg>
                                <span class="text-sm">Dashboard</span>
                            </a>

                            <!-- My Profile (Employee Only) -->
                            @if(auth()->user()->role === 'employee')
                                <a href="{{ route('employee.profile') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('employee.profile') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="text-sm">My Profile</span>
                                </a>
                            @endif

                            <!-- My Leaves -->
                            <a href="{{ route('leaves.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('leaves.*') && !request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm">My Leaves</span>
                            </a>
                            <!-- Manage Employees (Admin Only) -->
                            @if(in_array(auth()->user()->role, ['master.admin', 'super.admin']))
                                <a href="{{ route('employees.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('employees.*') && !request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-sm">Manage Employees</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Admin Section -->
                    @if(in_array(auth()->user()->role, ['master.admin', 'super.admin']))
                        <div class="mb-8 border-t border-gray-200 pt-8">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Admin</h3>
                            <div class="space-y-1">
                                <!-- Statistics -->
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span class="text-sm">Statistics</span>
                                </a>

                                <!-- Manage Leaves -->
                                <a href="{{ route('admin.leaves.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.leaves.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    <span class="text-sm">Manage Leaves</span>
                                </a>

                                <!-- Manage Employees -->
                                <a href="{{ route('employees.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('employees.*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M7 20H2v-2a3 3 0 015.856-1.487M15 9a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">Manage Employees</span>
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Super Admin Section -->
                    @if(auth()->user()->role === 'super.admin')
                        <div class="mb-8 border-t border-gray-200 pt-8">
                            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Super Admin</h3>
                            <div class="space-y-1">
                                <!-- Manage Roles -->
                                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-purple-50 text-purple-600 font-semibold' : 'text-gray-700 hover:bg-gray-100' }} transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="text-sm">Manage Roles</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </nav>

                <!-- Footer -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
                    <div class="px-4 py-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate capitalize">{{ str_replace('.', ' ', Auth::user()->role) }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg font-medium text-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="ml-64 flex-1 flex flex-col overflow-hidden">
                <!-- Header -->
                <header class="bg-white border-b border-gray-200 shadow-sm">
                    @isset($header)
                        <div class="px-8 py-6">
                            {{ $header }}
                        </div>
                    @else
                        <div class="px-8 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                            <h1 class="text-3xl font-bold text-gray-900">Welcome Back</h1>
                            <p class="text-sm text-gray-600 mt-1">{{ Auth::user()->name }}, manage your leaves and tasks</p>
                        </div>
                    @endisset
                </header>

                <!-- Content -->
                <main class="flex-1 overflow-auto bg-gray-50">
                    <div class="px-8 py-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
