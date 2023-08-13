<?php
namespace App\Http\Repositories;

use App\Models\FilialEmpresa;
use App\Models\User;
use Illuminate\Http\Request;


class FilialEmpresaRepository{
    
    protected $filialempresa;
    
    public function __construct(FilialEmpresa $filialempresa)
    {
        $this->filialempresa = $filialempresa;
    }
    public function getAll($limit){
        return FilialEmpresa::paginate($limit);
    }
    
    public function getById($id){
        return FilialEmpresa::findOrFail($id);
    }

    
    public function save($empresa_id,$nome_fantasia,$cnpj,$telefone,$status,$inscricao_estadual)
    {

        $filialempresa = new $this->filialempresa;

        $filialempresa->empresa_id = $empresa_id;
        $filialempresa->nome_fantasia = $nome_fantasia;
        $filialempresa->cnpj  = $cnpj;
        $filialempresa->telefone = $telefone;        
        $filialempresa->status = $status;
        $filialempresa->inscricao_estadual = $inscricao_estadual;
        $filialempresa->save();
        
        return $filialempresa->fresh();
    }

    public function update($id,$empresa_id,$nome_fantasia,$cnpj,$telefone,$status,$inscricao_estadual)
    {   
        $filialempresa = $this->filialempresa->find($id);   
        $filialempresa->$empresa_id = $empresa_id;      
        $filialempresa->nome_fantasia = $nome_fantasia;
        $filialempresa->cnpj  = $cnpj;
        $filialempresa->telefone = $telefone; 
        $filialempresa->status = $status;
        $filialempresa->inscricao_estadual = $inscricao_estadual; 
    
        $filialempresa->update();
        
        return $filialempresa->fresh();
    }    

    public function alterar_status($id)
    {
        if($id != null ){
            $filialempresa = $this->filialempresa->findOrFail($id);
            $filialempresa->update();
        } 
        return $filialempresa;  
    }

}