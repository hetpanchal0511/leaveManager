<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('employees.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
            <h2 class="font-semibold text-2xl text-gray-900">Employee Details</h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 px-8 py-6">
            <h3 class="text-2xl font-bold text-gray-900">{{ $employee->full_name }}</h3>
            <p class="text-gray-600 mt-1">{{ $employee->company_email }}</p>
        </div>

        <!-- Details -->
        <div class="p-8">
            <div class="grid grid-cols-2 gap-8">
                <!-- Column 1 -->
                <div class="space-y-6">
                    <!-- Company Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Company Email</label>
                        <p class="text-gray-700 font-medium">{{ $employee->company_email }}</p>
                    </div>

                    <!-- Personal Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Personal Email</label>
                        <p class="text-gray-700">{{ $employee->personal_email }}</p>
                    </div>

                    <!-- Mobile Number -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Mobile Number</label>
                        <p class="text-gray-700">{{ $employee->mobile_number }}</p>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="space-y-6">
                    <!-- Date of Birth -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Date of Birth</label>
                        <p class="text-gray-700">
                            @if($employee->dob)
                                {{ $employee->dob->format('d M Y') }}
                            @else
                                <span class="text-gray-400">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <!-- Joining Date -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Joining Date</label>
                        <p class="text-gray-700">
                            @if($employee->joining_date)
                                {{ $employee->joining_date->format('d M Y') }}
                            @else
                                <span class="text-gray-400">Not provided</span>
                            @endif
                        </p>
                    </div>

                    <!-- Added Date -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Record Created</label>
                        <p class="text-gray-700">{{ $employee->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-gray-50 border-t px-8 py-4 flex gap-3">
            <a href="{{ route('employees.edit', $employee) }}" class="inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
            <form method="POST" action="{{ route('employees.destroy', $employee) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                </button>
            </form>
            <a href="{{ route('employees.index') }}" class="inline-flex items-center gap-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>
                Back to List
            </a>
        </div>
    </div>
</x-app-layout>
