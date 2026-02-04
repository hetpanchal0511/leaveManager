<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;

class LeavePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Leave $leave): bool
    {
        // Admin/Super admin can view any leave
        if (in_array($user->role, ['master.admin', 'super.admin'])) {
            return true;
        }
        
        // Regular users can only view their own leaves
        return $user->id === $leave->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Leave $leave): bool
    {
        // Admin/Super admin can update any leave
        if (in_array($user->role, ['master.admin', 'super.admin'])) {
            return true;
        }
        
        // Regular users can only update their own pending leaves
        return $user->id === $leave->user_id && $leave->status === 'pending';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Leave $leave): bool
    {
        // Admin/Super admin can delete any leave
        if (in_array($user->role, ['master.admin', 'super.admin'])) {
            return true;
        }
        
        // Regular users can only delete their own pending leaves
        return $user->id === $leave->user_id && $leave->status === 'pending';
    }
}
