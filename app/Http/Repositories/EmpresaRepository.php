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

    
    public function getById($id){
        return $this->empresa->where('id',$id)->get();
    }

    public function save($user_id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email)
    {
        
        $empresa = new $this->empresa;
        $empresa->user_id = $user_id;
        $empresa->nome = $nome;
        $empresa->nome_social = $nome_social;
        $empresa->razao_social = $razao_social;
        $empresa->cnpj = $cnpj;
        $empresa->telefone = $telefone;        
        $empresa->email = $email;
        
        $empresa->save();
        
        return $empresa->fresh();
    }

    public function update($id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email)
    {   
        $empresa = $this->empresa->find($id);   
        $empresa->nome = $nome;
        $empresa->nome_social = $nome_social;
        $empresa->razao_social = $razao_social;
        $empresa->cnpj = $cnpj;
        $empresa->telefone = $telefone;        
        $empresa->email = $email;

        $empresa->update();
        
        return $empresa->fresh();
    }    

    public function delete($id)
    {
        if($id != null ){
            $empresa = $this->empresa->findOrFail($id);
            $empresa->delete();
        } 
        return $empresa;  
    }

}    