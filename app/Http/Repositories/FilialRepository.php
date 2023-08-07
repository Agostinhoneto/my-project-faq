<?php
namespace App\Http\Repositories;

use App\Models\Filial;
use App\Models\User;
use Illuminate\Http\Request;


class FilialRepository{
    
    protected $filial;

    public function getAllEmpresa($limit){
        return Filial::paginate($limit);
    }
    
    public function getById($id){
        return $this->filial->where('id',$id)->get();
    }
}