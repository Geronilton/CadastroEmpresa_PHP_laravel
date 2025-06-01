<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Segmentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function empresas()
    {
        return $this->hasMany(empresa::class);
    }
}
