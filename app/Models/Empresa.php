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
}
