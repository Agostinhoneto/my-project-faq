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
    
    public function getAll($limit){
        return Empresa::paginate($limit);
    }
    
    public function getById($id){
        return Empresa::findOrFail($id);
    }

    public function save($user_id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id,$status,$usuario_cadastrante_id,$usuario_alterante_id)
    {
        
        $empresa = new $this->empresa;
        $empresa->user_id = $user_id;
        $empresa->nome = $nome;
        $empresa->nome_social = $nome_social;
        $empresa->razao_social = $razao_social;
        $empresa->cnpj = $cnpj;
        $empresa->telefone = $telefone;        
        $empresa->email = $email;
        $empresa->tipo_empresa_id = $tipo_empresa_id;
        $empresa->natureza_empresa_id = $natureza_empresa_id; 
        $empresa->inscricao_empresa_id = $inscricao_empresa_id; 
        $empresa->status = $status;
        $empresa->usuario_cadastrante_id = $usuario_cadastrante_id;
        $empresa->usuario_alterante_id = $usuario_alterante_id;
        $empresa->save();
        
        return $empresa->fresh();
    }

    public function update($id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id,$status,$usuario_cadastrante_id,$usuario_alterante_id)
    {   
        $empresa = $this->empresa->find($id);   
        $empresa->nome = $nome;
        $empresa->nome_social = $nome_social;
        $empresa->razao_social = $razao_social;
        $empresa->cnpj = $cnpj;
        $empresa->telefone = $telefone;        
        $empresa->email = $email;
        $empresa->tipo_empresa_id = $tipo_empresa_id;
        $empresa->natureza_empresa = $natureza_empresa_id; 
        $empresa->inscricao_empresa_id = $inscricao_empresa_id;
        $empresa->usuario_cadastrante_id = $usuario_cadastrante_id;
        $empresa->usuario_alterante_id = $usuario_alterante_id; 
        $empresa->status = $status;

        $empresa->update();
        
        return $empresa->fresh();
    }    

    public function alterar_status($id)
    {
        $empresa = null;
        if($id != null ){
            $empresa = $this->empresa->findOrFail($id);
            $empresa->update();
        } 
        return $empresa;  
    }
}    