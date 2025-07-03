<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    // Desactiva los timestamps
    public $timestamps = false;

    // Especifica los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'empleado_id',
        'fecha_emision',
        'contenido',
        'tipo',
    ];

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
