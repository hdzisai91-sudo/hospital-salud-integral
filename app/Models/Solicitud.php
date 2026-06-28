<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tecnico;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'titulo',
        'subtitulo',
        'ubicacion',
        'fecha',
        'prioridad',
        'estado',
        'tecnico_id',
    ];

    /**
     * RELACIÓN: UNA SOLICITUD PERTENECE A UN TÉCNICO
     */
    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }
}