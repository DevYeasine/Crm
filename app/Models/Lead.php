<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_name',
        'job_title',
        'lead_source',
        'lead_status',
        'priority',
        'notes',
        'assigned_to',
        'tenant_id',
        'created_by',
        'status_changed_at',
        'last_contacted_at',
    ];

    /* ----------------- Relationships ----------------- */

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'related');
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
