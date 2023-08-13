<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = ['logradouro', 'numero', 'bairro', 'cidade', 'estado', 'cep'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function cidades()
    {
        return $this->hasMany(Cidade::class);
    }
}
