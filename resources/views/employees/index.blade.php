<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Employees') }}
            </h2>
            <a href="{{ route('employees.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Add Employee
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('username') && session('password'))
                <div class="bg-blue-100 dark:bg-blue-900/30 border border-blue-400 dark:border-blue-600 text-blue-700 dark:text-blue-300 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Employee Login Credentials Created!</strong>
                    <div class="mt-2">
                        <p class="text-sm"><strong>Username:</strong> {{ session('username') }}</p>
                        <p class="text-sm"><strong>Password:</strong> <code class="bg-blue-200 dark:bg-blue-800 px-2 py-1 rounded">{{ session('password') }}</code></p>
                        <p class="text-xs mt-2 text-blue-600 dark:text-blue-400">⚠️ Please copy these credentials and share them with the employee. This password will not be shown again.</p>
                    </div>
                </div>
            @endif

            <!-- Filter Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Search by Anything..</h3>
                    <form method="GET" action="{{ route('employees.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Employee Name</label>
                            <input type="text" id="name" name="name" value="{{ request('name') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" 
                                   placeholder="Search by name...">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ request('email') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" 
                                   placeholder="Search by email...">
                        </div>

                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mobile Number</label>
                            <input type="text" id="mobile" name="mobile" value="{{ request('mobile') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" 
                                   placeholder="Search by mobile...">
                        </div>

                        <div>
                            <label for="joining_month_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Month</label>
                            <select id="joining_month_from" name="joining_month_from" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="">-- Select Month --</option>
                                <option value="01" {{ request('joining_month_from') === '01' ? 'selected' : '' }}>January</option>
                                <option value="02" {{ request('joining_month_from') === '02' ? 'selected' : '' }}>February</option>
                                <option value="03" {{ request('joining_month_from') === '03' ? 'selected' : '' }}>March</option>
                                <option value="04" {{ request('joining_month_from') === '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ request('joining_month_from') === '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{ request('joining_month_from') === '06' ? 'selected' : '' }}>June</option>
                                <option value="07" {{ request('joining_month_from') === '07' ? 'selected' : '' }}>July</option>
                                <option value="08" {{ request('joining_month_from') === '08' ? 'selected' : '' }}>August</option>
                                <option value="09" {{ request('joining_month_from') === '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ request('joining_month_from') === '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ request('joining_month_from') === '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ request('joining_month_from') === '12' ? 'selected' : '' }}>December</option>
                            </select>
                        </div>

                        <div>
                            <label for="joining_month_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To Month</label>
                            <select id="joining_month_to" name="joining_month_to" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                <option value="">-- Select Month --</option>
                                <option value="01" {{ request('joining_month_to') === '01' ? 'selected' : '' }}>January</option>
                                <option value="02" {{ request('joining_month_to') === '02' ? 'selected' : '' }}>February</option>
                                <option value="03" {{ request('joining_month_to') === '03' ? 'selected' : '' }}>March</option>
                                <option value="04" {{ request('joining_month_to') === '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ request('joining_month_to') === '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{ request('joining_month_to') === '06' ? 'selected' : '' }}>June</option>
                                <option value="07" {{ request('joining_month_to') === '07' ? 'selected' : '' }}>July</option>
                                <option value="08" {{ request('joining_month_to') === '08' ? 'selected' : '' }}>August</option>
                                <option value="09" {{ request('joining_month_to') === '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ request('joining_month_to') === '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ request('joining_month_to') === '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ request('joining_month_to') === '12' ? 'selected' : '' }}>December</option>
                            </select>
                        </div>

                        <div class="flex gap-2 items-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex-1">
                                Search
                            </button>
                            <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex-1 text-center">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($employees->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Full Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Company Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Personal Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Mobile</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Joining Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $employee->full_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->company_email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->personal_email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->mobile_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($employee->joining_date)
                                                    {{ $employee->joining_date->format('M d, Y') }}
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                                <a href="{{ route('employees.show', $employee) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">View</a>
                                                <a href="{{ route('employees.edit', $employee) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</a>
                                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No employees found. <a href="{{ route('employees.create') }}" class="text-blue-500 hover:underline">Add the first employee</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
