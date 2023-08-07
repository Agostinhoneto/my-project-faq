<?php

namespace App\Http\Controllers;

use App\HttpStatusCodes;
use Illuminate\Support\Facades\Validator;
use App\Services\FilialEmpresaService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilialEmpresaController extends Controller
{    
    public function __construct(private FilialEmpresaService $filialEmpresaService)
    {
        $this->filialEmpresaService = $filialEmpresaService;
    }

    public function index()
    {
        $limit = 10;
        try{
           return $result['data'] = $this->filialEmpresaService->getAll($limit); 
            response()->json([
                'message' => 'Dados retornados com Sucesso',
            ], HttpStatusCodes::OK,$result);       
        }   
        catch(Exception $e){
            return response()->json([
                'message' => 'Erro ao tentar trazer os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);        
        }
    }

    public function show($id){
        try{
            $result['data'] = $this->filialEmpresaService->getById($id);
            return response()->json(['message' => 'Retorno do valor com sucesso!',HttpStatusCodes::OK,$result]);
        }
        catch(Exception $e){
            return response()->json([
                'message' => 'Erro ao tentar trazer os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }

    
    /*
    public function register(Request $request)
    {  
        $dados = [
           // $user_id              = $request->input('user_id'),
            $nome                 = $request->input('nome'),
            $nome_social          = $request->input('nome_social'),
            $razao_social         = $request->input('razao_social'),
            $cnpj                 = $request->input('cnpj'),
            $telefone             = $request->input('telefone'),
            $email                = $request->input('email'),
        ];
        
        DB::beginTransaction();
        try {
            $result['data'] =  $this->filialEmpresaService->register(
           // $user_id,
            $nome,
            $nome_social, 
            $razao_social,
            $cnpj,
            $telefone,
            $email,
            );
            DB::commit();
            return response()->json(['message' => 'Filial criada com sucesso!',HttpStatusCodes::CREATED]);
        }catch(Exception $e){
            dd($e);
            DB::roolBack();
            return response()->json([
                'message' => 'Erro ao criar os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {        
        $request->validate([
            'nome' => 'required|unique',
            'nome_social' => 'required|string|max:50',
            'razao_social' => 'required|string|max:50|unique',
            'cnpj' => 'required|integer|max:12|unique', 
            'telefone' => 'required|integer|max:11',
            'email'    => 'required|string|email'
        ]);
        
        $id              = $request->input('id');
        $nome            = $request->input('nome');
        $nome_social     = $request->input('nome_social');
        $razao_social    = $request->input('razao_social');
        $cnpj            = $request->input('cnpj');
        $telefone        = $request->input('telefone');
        $email           = $request->input('email');
        $tipo_empresa_id = $request->input('tipo_empresa_id');
        $natureza_empresa_id = $request->input('natureza_empresa_id');
        $inscricao_empresa_id  = $request->input('inscricao_empresa_id');
     
        DB::beginTransaction();
        try {
           $result['data'] = $this->empresaService->update(
                $id,
                $nome,
                $nome_social, 
                $razao_social,
                $cnpj,
                $telefone,
                $email,
                $tipo_empresa_id,
                $natureza_empresa_id, 
                $inscricao_empresa_id 
            );
            DB::commit();
            return response()->json(['message' => 'Empresa atualizada com sucesso!',HttpStatusCodes::OK]);
          }catch(Exception $e){
            DB::roolBack();
            return response()->json([
                'message' => 'Erro ao atualizar os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }

    public function update_destroy($id){
        //alterar status 0 , 1
        DB::beginTransaction();      
        try{
            $this->empresaService->deleteById($id);
            DB::commit();
            return response()->json(['message' => 'Empresa Deletado com sucesso!',HttpStatusCodes::OK]);
        }catch(Exception $e){
            DB::roolBack();
            return response()->json([
                'message' => 'Erro ao deletar os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }
    */
}
