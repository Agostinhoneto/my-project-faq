<?php
namespace App\Http\Repositories;

use App\Models\FilialEmpresa;
use App\Models\User;
use Illuminate\Http\Request;


class FilialEmpresaRepository{
    
    protected $filialempresa;

    public function getAll($limit){
        return FilialEmpresa::paginate($limit);
    }
    
    public function getById($id){
        return FilialEmpresa::findOrFail($id);
        //return $this->filialempresa->where('id',$id)->get();
    }

    
    public function save($nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id)
    {
        
        $empresa = new $this->filialempresa;
       // $empresa->user_id = $user_id;
        $empresa->nome = $nome;
        $empresa->nome_social = $nome_social;
        $empresa->razao_social = $razao_social;
        $empresa->cnpj = $cnpj;
        $empresa->telefone = $telefone;        
        $empresa->email = $email;
        $empresa->tipo_empresa_id = $tipo_empresa_id;
        $empresa->natureza_empresa_id = $natureza_empresa_id; 
        $empresa->inscricao_empresa_id = $inscricao_empresa_id; 
        
        $empresa->save();
        
        return $empresa->fresh();
    }

    public function update($id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id)
    {   
        $empresa = $this->filialempresa->find($id);   
        $empresa->nome = $nome;
        $empresa->nome_social = $nome_social;
        $empresa->razao_social = $razao_social;
        $empresa->cnpj = $cnpj;
        $empresa->telefone = $telefone;        
        $empresa->email = $email;
        $empresa->tipo_empresa_id = $tipo_empresa_id;
        $empresa->natureza_empresa = $natureza_empresa_id; 
        $empresa->inscricao_empresa_id = $inscricao_empresa_id; 

        $empresa->update();
        
        return $empresa->fresh();
    }    

    public function delete($id)
    {
        if($id != null ){
            $empresa = $this->filialempresa->findOrFail($id);
            $empresa->delete();
        } 
        return $empresa;  
    }

}