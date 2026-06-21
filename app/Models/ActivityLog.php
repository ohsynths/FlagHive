<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

/** @method static \App\Models\ActivityLog create(array $attributes) */
class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'description', 'ip_address', 'user_agent', 'subject_id', 'subject_type'];

    protected static function booted(): void
    {
        static::creating(function (self $log) {
            if (is_null($log->ip_address)) {
                $log->ip_address = Request::ip();
            }
            if (is_null($log->user_agent)) {
                $log->user_agent = mb_substr((string) Request::userAgent(), 0, 500);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }
}
