<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'alternate_phone',
        'company', 'job_title', 'department',
        'street', 'city', 'state', 'postal_code', 'country',
        'lead_source', 'contact_type', 'status', 'notes',
        'created_by', 'tenant_id'
    ];

    /* 🔹 Relations */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    /* 🔹 Accessors */
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /* 🔹 Scopes */
    public function scopeByTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('contact_type', $type);
    }
}
