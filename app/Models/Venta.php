<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'rut',
        'nombre',
        'apellido',
        'boleta',
        'forma_pago',
        'fecha_pago',
        'cuota',
        'valor',
        'total',
        'cancelado',
        'matricula_id',
        'certificado_id',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function certificado()
    {
        return $this->hasOne(Certificado::class);
    }
}
