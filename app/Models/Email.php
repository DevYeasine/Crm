<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Email extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject',
        'body',
        'direction',
        'from_user_id',
        'from_email',
        'to',
        'cc',
        'bcc',
        'lead_id',
        'deal_id',
        'project_id',
        'contact_id',
        'attachments',
        'status',
        'tenant_id',
    ];

    protected $casts = [
        'to' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        'attachments' => 'array',
    ];

    // Sender user
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    // Related lead
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    // Related deal
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    // Related project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Related contact
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // Related tenant
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
