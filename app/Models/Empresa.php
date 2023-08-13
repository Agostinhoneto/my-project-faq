<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

     // Relacionamento com o modelo User (muitas empresas pertencem a um usuário)
     public function user()
     {
         return $this->belongsTo(user::class);
     }

    public function tipo_empresa()
    {
        return $this->belongsTo(Tipo_empresa::class);
    }

    public function natureza_empresa()
    {
        return $this->belongsTo(Natureza_empresa::class);
    }

    public function inscricao_social()
    {
        return $this->belongsTo(Inscricao_social::class);
    }

}


