<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActaEditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'acta_id',
        'user_id',
        'attendee_id',
        'field',
        'old_value',
        'new_value',
        'edited_at',
        'ip_address',
    ];

    protected $casts = [
        'edited_at' => 'datetime',
    ];

    public function acta(): BelongsTo
    {
        return $this->belongsTo(Acta::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendee(): BelongsTo
    {
        return $this->belongsTo(Attendee::class);
    }
}
