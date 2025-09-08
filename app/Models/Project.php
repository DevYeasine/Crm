<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'deal_id',
        'client_id',
        'project_name',
        'description',
        'budget',
        'actual_cost',
        'start_date',
        'end_date',
        'expected_delivery_date',
        'status',
        'progress',
        'priority',
        'project_manager',
        'team_members',
        'created_by',
        'tenant_id',
    ];

    protected $casts = [
        'team_members' => 'array', 
        'start_date' => 'date',
        'end_date' => 'date',
        'expected_delivery_date' => 'date',
    ];

    /* ==========================
       Relationships
    ========================== */

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function client()
    {
        return $this->belongsTo(Contact::class, 'client_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'project_manager');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /* ==========================
       Query Scopes
    ========================== */

    public function scopeByTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
