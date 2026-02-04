<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index(Request $request): View
    {
        // Only master.admin and super.admin can manage employees
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $query = Employee::with('user');

        // Filter by name
        if ($request->filled('name')) {
            $query->where('full_name', 'like', '%' . $request->input('name') . '%');
        }

        // Filter by email
        if ($request->filled('email')) {
            $query->where(function ($q) use ($request) {
                $q->where('company_email', 'like', '%' . $request->input('email') . '%')
                  ->orWhere('personal_email', 'like', '%' . $request->input('email') . '%');
            });
        }

        // Filter by joining month (from)
        if ($request->filled('joining_month_from')) {
            $fromMonth = $request->input('joining_month_from');
            $query->whereMonth('joining_date', '>=', $fromMonth);
        }

        // Filter by joining month (to)
        if ($request->filled('joining_month_to')) {
            $toMonth = $request->input('joining_month_to');
            $query->whereMonth('joining_date', '<=', $toMonth);
        }

        // Filter by mobile number
        if ($request->filled('mobile')) {
            $query->where('mobile_number', 'like', '%' . $request->input('mobile') . '%');
        }

        $employees = $query->paginate(10)->appends($request->query());
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create(): View
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.create');
    }

    /**
     * Store a newly created employee in database.
     */
    public function store(Request $request): RedirectResponse
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:employees',
            'personal_email' => 'required|email|unique:employees',
            'mobile_number' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'joining_date' => 'nullable|date',
            'username' => 'required|email|unique:users,email',
        ]);

        // Generate a random secure password
        $generatedPassword = \Illuminate\Support\Str::random(12);

        // Create user account for the employee
        $user = \App\Models\User::create([
            'name' => $validated['full_name'],
            'email' => $validated['username'],
            'password' => \Illuminate\Support\Facades\Hash::make($generatedPassword),
            'role' => 'employee',
        ]);

        // Create employee record
        Employee::create([
            'user_id' => $user->id,
            'full_name' => $validated['full_name'],
            'company_email' => $validated['company_email'],
            'personal_email' => $validated['personal_email'],
            'mobile_number' => $validated['mobile_number'],
            'dob' => $validated['dob'],
            'joining_date' => $validated['joining_date'],
        ]);

        return redirect()->route('employees.index')
                        ->with('success', 'Employee added successfully!')
                        ->with('username', $validated['username'])
                        ->with('password', $generatedPassword);
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee): View
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee): View
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in database.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:employees,company_email,' . $employee->id,
            'personal_email' => 'required|email|unique:employees,personal_email,' . $employee->id,
            'mobile_number' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'joining_date' => 'nullable|date',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')
                        ->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified employee from database.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        if (!in_array(auth()->user()->role, ['master.admin', 'super.admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $employee->delete();

        return redirect()->route('employees.index')
                        ->with('success', 'Employee deleted successfully!');
    }

    /**
     * Show the employee's own profile
     */
    public function myProfile(): View
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        
        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }

        return view('employees.profile', compact('employee'));
    }

    /**
     * Update employee's own credentials (username and password)
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'username' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update username (email)
        $user->email = $validated['username'];

        // Update password if provided
        if (!empty($validated['password'])) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('employee.profile')
                        ->with('success', 'Profile updated successfully!');
    }
}
