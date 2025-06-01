<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cep',
        'rua',
        'numero',
        'bairro',
        'estado',
        'whatsapp',
        'documento',
        'segmento_id',
    ];

    public function segmento()
    {
        return $this->belongsTo(Segmentos::class);
    }
}
