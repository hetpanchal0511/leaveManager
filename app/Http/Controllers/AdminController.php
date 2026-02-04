<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin dashboard
     */
    public function dashboard()
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized access');
        }
        
        $totalLeaves = Leave::count();
        $pendingLeaves = Leave::where('status', 'pending')->count();
        $approvedLeaves = Leave::where('status', 'approved')->count();
        $rejectedLeaves = Leave::where('status', 'rejected')->count();
        $totalUsers = User::where('role', 'employee')->count();

        return view('admin.dashboard', compact(
            'totalLeaves',
            'pendingLeaves',
            'approvedLeaves',
            'rejectedLeaves',
            'totalUsers'
        ));
    }

    /**
     * View all leave requests
     */
    public function viewLeaves(Request $request)
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized access');
        }
        
        $query = Leave::with('user');

        // Filter by employee name
        if ($request->filled('employee_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('employee_name') . '%');
            });
        }

        // Filter by leave type
        if ($request->filled('leave_type')) {
            $query->where('leave_type', $request->input('leave_type'));
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by start month (from)
        if ($request->filled('start_month_from')) {
            $fromMonth = $request->input('start_month_from');
            $query->whereMonth('start_date', '>=', $fromMonth);
        }

        // Filter by start month (to)
        if ($request->filled('start_month_to')) {
            $toMonth = $request->input('start_month_to');
            $query->whereMonth('start_date', '<=', $toMonth);
        }
        
        $leaves = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());
        return view('admin.leaves.index', compact('leaves'));
    }

    /**
     * View leave details
     */
    public function viewLeaveDetails(Leave $leave)
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized access');
        }
        
        return view('admin.leaves.show', compact('leave'));
    }

    /**
     * Approve leave
     */
    public function approveLeave(Leave $leave)
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized access');
        }
        
        $leave->update(['status' => 'approved']);
        return redirect()->route('admin.leaves.index')->with('success', 'Leave approved successfully.');
    }

    /**
     * Reject leave
     */
    public function rejectLeave(Request $request, Leave $leave)
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized access');
        }
        
        $request->validate([
            'rejection_reason' => 'nullable|string',
        ]);

        $leave->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        return redirect()->route('admin.leaves.index')->with('success', 'Leave rejected successfully.');
    }

    /**
     * View all users
     */
    public function viewUsers()
    {
        if (auth()->user()->role !== 'super.admin') {
            abort(403, 'Unauthorized access');
        }
        
        $users = User::where('role', '!=', 'super.admin')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Change user role
     */
    public function changeUserRole(Request $request, User $user)
    {
        if (auth()->user()->role !== 'super.admin') {
            abort(403, 'Unauthorized access');
        }
        
        $validated = $request->validate([
            'role' => 'required|in:employee,master.admin',
        ]);

        $user->update(['role' => $validated['role']]);
        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }
}
