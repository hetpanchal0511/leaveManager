<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leave Request Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Employee Name</h3>
                            <p class="mt-1 text-lg">{{ $leave->user->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</h3>
                            <p class="mt-1 text-lg">{{ $leave->user->email }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Leave Type</h3>
                            <p class="mt-1 text-lg">{{ $leave->leave_type }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</h3>
                            <p class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($leave->status === 'approved') bg-green-100 text-green-800
                                    @elseif($leave->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($leave->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Start Date</h3>
                            <p class="mt-1 text-lg">{{ $leave->start_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">End Date</h3>
                            <p class="mt-1 text-lg">{{ $leave->end_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Number of Days</h3>
                            <p class="mt-1 text-lg">{{ $leave->days }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Submitted On</h3>
                            <p class="mt-1 text-lg">{{ $leave->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Reason</h3>
                        <p class="mt-2 text-lg">{{ $leave->reason }}</p>
                    </div>

                    @if($leave->status === 'rejected' && $leave->rejection_reason)
                        <div class="mb-6 bg-red-50 dark:bg-red-900/20 p-4 rounded">
                            <h3 class="text-sm font-medium text-red-600 dark:text-red-400">Rejection Reason</h3>
                            <p class="mt-2">{{ $leave->rejection_reason }}</p>
                        </div>
                    @endif

                    <div class="flex justify-between">
                        <a href="{{ route('admin.leaves.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
                        @if($leave->status === 'pending')
                            <div class="space-x-2">
                                <form action="{{ route('admin.leaves.approve', $leave) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve</button>
                                </form>
                                <button onclick="showRejectForm()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Reject Leave Request</h3>
            <form action="{{ route('admin.leaves.reject', $leave) }}" method="POST" class="mt-4">
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
        function showRejectForm() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function closeRejectForm() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
