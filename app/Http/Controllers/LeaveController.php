<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Leave::where('user_id', Auth::id());

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
        
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $startDate = new \DateTime($validated['start_date']);
        $endDate = new \DateTime($validated['end_date']);
        $days = $startDate->diff($endDate)->days + 1;

        Leave::create([
            'user_id' => Auth::id(),
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'days' => $days,
            'status' => 'pending',
        ]);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leaf)
    {
        $this->authorize('view', $leaf);
        return view('leaves.show', ['leave' => $leaf]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leaf)
    {
        $this->authorize('update', $leaf);
        return view('leaves.edit', ['leave' => $leaf]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leaf)
    {
        $this->authorize('update', $leaf);

        $validated = $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $startDate = new \DateTime($validated['start_date']);
        $endDate = new \DateTime($validated['end_date']);
        $days = $startDate->diff($endDate)->days + 1;

        $leaf->update([
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'days' => $days,
        ]);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leaf)
    {
        $this->authorize('delete', $leaf);
        
        $leaf->delete();

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request deleted successfully.');
    }
}
