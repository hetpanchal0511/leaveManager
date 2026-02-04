<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'company_email',
        'personal_email',
        'mobile_number',
        'dob',
        'joining_date',
    ];

    protected $casts = [
        'dob' => 'date',
        'joining_date' => 'date',
    ];

    /**
     * Get the user associated with the employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
