<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    // Desactiva los timestamps
    public $timestamps = false;

    // Especifica los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'dni',
        'nombre',
        'fecha_ingreso',
        'tipo',
    ];

    // Relación con el modelo Salario
    public function salarios()
    {
        return $this->hasMany(Salario::class);
    }

    // Relación con el modelo Reporte
    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }

    // Relación con el modelo Notificacion
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }
}
