<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudmantenimiento extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_mantenimiento';

    protected $fillable = [
        'codigo_equipo',
        'nombre_equipo',
        'area_ubicacion',
        'falla_reportada',
        'prioridad',
        'estado'
    ];
}