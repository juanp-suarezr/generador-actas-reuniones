<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoActa extends Model
{
    use HasFactory;

    protected $table = 'estados_actas';

    protected $fillable = ['name'];
}
