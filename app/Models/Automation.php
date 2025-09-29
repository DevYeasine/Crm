<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Automation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'tenant_id',
        'created_by',
        'trigger_type',
        'trigger_condition',
        'action_type',
        'action_details',
        'status',
    ];

    /*  Relationships */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* 🔹 Casts for JSON fields */
    protected $casts = [
        'trigger_condition' => 'array',
        'action_details' => 'array',
    ];

    /* 🔹 Scopes */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }
}
