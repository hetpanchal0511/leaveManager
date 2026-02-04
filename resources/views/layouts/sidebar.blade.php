<div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gray-900 text-white transition-all duration-300 overflow-hidden fixed h-screen z-40">
        <!-- Logo Area -->
        <div class="p-4 flex items-center justify-between border-b border-gray-700">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <span class="text-2xl font-bold">LM</span>
                <span x-show="sidebarOpen" class="text-sm font-semibold">LeaveManager</span>
            </a>
            <button @click="sidebarOpen = !sidebarOpen" class="p-1 hover:bg-gray-800 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-8 space-y-2 px-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600' : 'hover:bg-gray-800' }} transition">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                </svg>
                <span x-show="sidebarOpen" class="text-sm">Dashboard</span>
            </a>

            <!-- My Leaves -->
            <a href="{{ route('leaves.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('leaves.*') && !request()->routeIs('admin.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }} transition">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span x-show="sidebarOpen" class="text-sm">My Leaves</span>
            </a>

            <!-- Admin Section -->
            @if(in_array(auth()->user()->role, ['master.admin', 'super.admin']))
                <div class="pt-4 border-t border-gray-700 mt-4">
                    <p x-show="sidebarOpen" class="px-4 text-xs uppercase text-gray-500 font-semibold mb-3">Admin</p>
                    
                    <!-- Manage Leaves -->
                    <a href="{{ route('admin.leaves.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.leaves.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }} transition">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span x-show="sidebarOpen" class="text-sm">Manage Leaves</span>
                    </a>

                    <!-- Manage Employees (Super Admin Only) -->
                    @if(auth()->user()->role === 'super.admin')
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-blue-600' : 'hover:bg-gray-800' }} transition">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span x-show="sidebarOpen" class="text-sm">Manage Employees</span>
                        </a>

                        <!-- Admin Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-800' }} transition">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span x-show="sidebarOpen" class="text-sm">Admin Dashboard</span>
                        </a>
                    @endif
                </div>
            @endif
        </nav>

        <!-- Bottom Section -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700 bg-gray-900">
            <div class="flex items-center justify-between gap-2">
                <div x-show="sidebarOpen" class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ str_replace('.', ' ', ucfirst(Auth::user()->role)) }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" title="Logout" class="p-2 hover:bg-gray-800 rounded transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 flex flex-col overflow-hidden transition-all duration-300">
        <!-- Top Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h1>
            <div class="text-sm text-gray-600">Welcome back!</div>
        </div>

        <!-- Page Content -->
        <main class="flex-1 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</div>
