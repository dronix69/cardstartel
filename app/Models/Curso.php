<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso', 
        'codigo', 
        'tipo', 
        'fecha_start', 
        'fecha_end',
        'certificado_id',
        'matricula_id',
    ];

    public function certificado()
    {
        return $this->hasOne(Certificado::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
