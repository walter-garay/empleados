<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    // Desactiva los timestamps
    public $timestamps = false;

    // Especifica los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'salario_id',
        'monto_pagado',
        'fecha_pago',
        'metodo_pago',
        'periodo',
    ];

    // Relación con el modelo AjustePago
    public function ajustesPagos()
    {
        return $this->hasMany(AjustePago::class);
    }

    // Relación con el modelo Salario
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
}
