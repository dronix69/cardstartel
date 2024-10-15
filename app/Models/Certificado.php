<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'rut',
        'codigo_curso',
        'fecha_start',
        'fecha_end',
        'certificado',
        'fecha_otorgado',
        'curso_id',
        'venta_id',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
