<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    // Desactiva los timestamps
    public $timestamps = false;

    // Especifica los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'empleado_id',
        'mensaje',
        'fecha_envio',
        'tipo',
    ];

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
