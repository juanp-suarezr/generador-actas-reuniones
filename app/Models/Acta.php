<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Acta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_acta',
        'tema',
        'subproceso',
        'fecha',
        'numero_acta',
        'tipo',
        'lugar',
        'responsable',
        'descripcion',
        'compromisos',
        'user_id',
        'share_token',
        'share_expires_at',
    ];

    protected $casts = [
        'fecha' => 'date',
        'compromisos' => 'array',
        'share_expires_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($acta) {
            if (empty($acta->share_token)) {
                $acta->share_token = Str::random(32);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class);
    }

    public function editLogs(): HasMany
    {
        return $this->hasMany(ActaEditLog::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['fecha'])) {
            $query->whereDate('fecha', $filters['fecha']);
        }

        if (isset($filters['tipo'])) {
            $query->where('tipo', $filters['tipo']);
        }

        if (isset($filters['estado'])) {
            // Assuming estado is added later, for now skip
        }

        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('nombre_acta', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('tema', 'like', '%' . $filters['search'] . '%');
            });
        }
    }

    public function canEditDescription($userOrAttendee)
    {
        // Logic to check if can edit (once per participant)
        $logs = $this->editLogs()->where('field', 'descripcion');
        if ($userOrAttendee instanceof User) {
            return $logs->where('user_id', $userOrAttendee->id)->count() === 0;
        } else {
            return $logs->where('attendee_id', $userOrAttendee->id)->count() === 0;
        }
    }

    public function canEditCompromisos($userOrAttendee)
    {
        $logs = $this->editLogs()->where('field', 'compromisos');
        if ($userOrAttendee instanceof User) {
            return $logs->where('user_id', $userOrAttendee->id)->count() === 0;
        } else {
            return $logs->where('attendee_id', $userOrAttendee->id)->count() === 0;
        }
    }
}
