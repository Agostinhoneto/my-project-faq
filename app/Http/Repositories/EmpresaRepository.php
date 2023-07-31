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

    public function save($id,$user_id,$nome,$nome_social,$razao_social,$endereco,$cnpj,$telefone,$email)
    {
        
        $empresa = new $this->empresa;
        $empresa->id = $id;
        $empresa->user_id = $user_id;
        $empresa->nome = $nome;
        $empresa->nome_social = $nome_social;
        $empresa->razao_social = $razao_social;
        $empresa->endereco = $endereco;
        $empresa->cnpj = $cnpj;
        $empresa->telefone = $telefone;        
        $empresa->email = $email;
        
        $empresa->save();
        
        return $empresa->fresh();
    }

    public function update($id,$name,$email,$password)
    {   
       
        $user = $this->empresa->find($id);
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;    
        $user->update();
        return $user->fresh();
    }    

    public function delete($id)
    {
        if($id != null ){
            $user = $this->empresa->findOrFail($id);
            $user->delete();
        } 
        return $user;  
    }

}    