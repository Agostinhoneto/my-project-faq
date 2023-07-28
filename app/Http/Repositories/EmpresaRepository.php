<?php
namespace App\Http\Repositories;
use App\Models\Empresa;
use Illuminate\Http\Request;


class EmpresaRepository{
    
    protected $empresa;
    
    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }
    
    public function getAllEmpresa(){
        return $this->empresa->get();
    }

}    