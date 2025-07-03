<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjustePago extends Model
{
    use HasFactory;

    // Desactiva los timestamps
    public $timestamps = false;

    // Especifica los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'pago_id',
        'tipo',
        'descripcion',
        'monto',
    ];

    // Relación con el modelo Pago
    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
}
