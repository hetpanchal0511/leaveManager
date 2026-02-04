<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <!-- Total Leaves Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Leaves</h3>
                        <p class="mt-2 text-3xl font-bold">{{ $totalLeaves }}</p>
                    </div>
                </div>

                <!-- Pending Leaves Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-yellow-400">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Pending</h3>
                        <p class="mt-2 text-3xl font-bold text-yellow-600">{{ $pendingLeaves }}</p>
                    </div>
                </div>

                <!-- Approved Leaves Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-400">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Approved</h3>
                        <p class="mt-2 text-3xl font-bold text-green-600">{{ $approvedLeaves }}</p>
                    </div>
                </div>

                <!-- Rejected Leaves Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-400">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Rejected</h3>
                        <p class="mt-2 text-3xl font-bold text-red-600">{{ $rejectedLeaves }}</p>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Employees</h3>
                        <p class="mt-2 text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.leaves.index') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Manage All Leave Requests
                        </a>
                        @if(auth()->user()->role === 'super.admin')
                            <a href="{{ route('admin.users.index') }}" class="block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                Manage Users & Roles
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
