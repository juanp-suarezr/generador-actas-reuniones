<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'acta_id',
        'nombre',
        'cedula',
        'proceso_entidad',
        'cargo',
        'telefono',
        'correo',
        'direccion',
        'comuna_corregimiento',
        'firma_path',
        'user_id',
    ];

    public function acta(): BelongsTo
    {
        return $this->belongsTo(Acta::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function editLogs(): HasMany
    {
        return $this->hasMany(ActaEditLog::class);
    }
}
