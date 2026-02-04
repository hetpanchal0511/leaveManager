<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filter Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Search & Filter</h3>
                    <form method="GET" action="{{ route('admin.leaves.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <!-- Employee Name -->
                            <div>
                                <label for="employee_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Employee Name</label>
                                <input type="text" id="employee_name" name="employee_name" value="{{ request('employee_name') }}" placeholder="Search by name" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:outline-none focus:ring-blue-500">
                            </div>

                            <!-- Leave Type -->
                            <div>
                                <label for="leave_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Leave Type</label>
                                <select id="leave_type" name="leave_type" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:outline-none focus:ring-blue-500">
                                    <option value="">All Types</option>
                                    <option value="Sick Leave" {{ request('leave_type') === 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                                    <option value="Casual Leave" {{ request('leave_type') === 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                                    <option value="Annual Leave" {{ request('leave_type') === 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
                                    <option value="Maternity Leave" {{ request('leave_type') === 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                                    <option value="Paternity Leave" {{ request('leave_type') === 'Paternity Leave' ? 'selected' : '' }}>Paternity Leave</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:outline-none focus:ring-blue-500">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <!-- Start Month From -->
                            <div>
                                <label for="start_month_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Month</label>
                                <select id="start_month_from" name="start_month_from" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:outline-none focus:ring-blue-500">
                                    <option value="">-- Select Month --</option>
                                    <option value="01" {{ request('start_month_from') === '01' ? 'selected' : '' }}>January</option>
                                    <option value="02" {{ request('start_month_from') === '02' ? 'selected' : '' }}>February</option>
                                    <option value="03" {{ request('start_month_from') === '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ request('start_month_from') === '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ request('start_month_from') === '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ request('start_month_from') === '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ request('start_month_from') === '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ request('start_month_from') === '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ request('start_month_from') === '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ request('start_month_from') === '10' ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ request('start_month_from') === '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ request('start_month_from') === '12' ? 'selected' : '' }}>December</option>
                                </select>
                            </div>

                            <!-- Start Month To -->
                            <div>
                                <label for="start_month_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To Month</label>
                                <select id="start_month_to" name="start_month_to" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:outline-none focus:ring-blue-500">
                                    <option value="">-- Select Month --</option>
                                    <option value="01" {{ request('start_month_to') === '01' ? 'selected' : '' }}>January</option>
                                    <option value="02" {{ request('start_month_to') === '02' ? 'selected' : '' }}>February</option>
                                    <option value="03" {{ request('start_month_to') === '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ request('start_month_to') === '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ request('start_month_to') === '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ request('start_month_to') === '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ request('start_month_to') === '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ request('start_month_to') === '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ request('start_month_to') === '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ request('start_month_to') === '10' ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ request('start_month_to') === '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ request('start_month_to') === '12' ? 'selected' : '' }}>December</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition">Search</button>
                            <a href="{{ route('admin.leaves.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-md transition">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($leaves->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Employee</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Start Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">End Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Days</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($leaves as $leave)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium">{{ $leave->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $leave->user->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $leave->leave_type }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $leave->start_date->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $leave->end_date->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $leave->days }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($leave->status === 'approved') bg-green-100 text-green-800
                                                    @elseif($leave->status === 'rejected') bg-red-100 text-red-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ ucfirst($leave->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.leaves.show', $leave) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 mr-3">View</a>
                                                @if($leave->status === 'pending')
                                                    <form action="{{ route('admin.leaves.approve', $leave) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 mr-3">Approve</button>
                                                    </form>
                                                    <button onclick="showRejectForm({{ $leave->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400">Reject</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No leave requests found.</p>
                    @endif

                    <!-- Pagination -->
                    @if($leaves->hasPages())
                        <div class="mt-6">
                            {{ $leaves->render() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Reject Leave Request</h3>
            <form id="rejectForm" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason (Optional)</label>
                    <textarea id="rejection_reason" name="rejection_reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeRejectForm()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showRejectForm(leaveId) {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectForm').action = '/admin/leaves/' + leaveId + '/reject';
        }
        function closeRejectForm() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
