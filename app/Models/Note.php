<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'note_text',
        'related_type',
        'related_id',
        'created_by',
        'tenant_id',
    ];

    /* 🔗 Relationships */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /* 🔹 Polymorphic Relation */
    public function related()
    {
        return $this->morphTo();
    }

    /* 🔹 Scopes */
    public function scopeByTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public function scopeForModel($query, $modelType, $modelId)
    {
        return $query->where('related_type', $modelType)
                     ->where('related_id', $modelId);
    }
}
