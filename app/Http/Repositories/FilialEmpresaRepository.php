<?php
namespace App\Http\Repositories;

use App\Models\FilialEmpresa;
use App\Models\User;
use Illuminate\Http\Request;


class FilialEmpresaRepository{
    
    protected $filialempresa;

    public function getAllEmpresa($limit){
        return FilialEmpresa::paginate($limit);
    }
    
    public function getById($id){
        return $this->filialempresa->where('id',$id)->get();
    }
}