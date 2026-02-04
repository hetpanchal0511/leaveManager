<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Dashboard") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Leaves Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">My Total Leaves</h3>
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
            </div>

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-600 dark:text-gray-400">Manage your leave requests and view your leave statistics from this dashboard.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
