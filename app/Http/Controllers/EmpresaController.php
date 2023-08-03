<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use App\Services\EmpresaService;

class EmpresaController extends Controller
{
 
    public function __construct(private EmpresaService $empresaService)
    {
        $this->empresaService = $empresaService;
        // $this->middleware('auth:api', ['except' => ['login','register','store']]);  
    }

    public function index()
    {
        $limit = 10;
        $result = ['status' => 200];   
        try{
            $result['data'] = $this->empresaService->getAll($limit); 
        }   
        catch(Exception $e){
            $result = [
                'status' => 500,
                'error' =>$e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);     
    }

    public function show($id){
        $result = ['status' =>200];
        try{
            $result['data'] = $this->empresaService->getById($id);
        }
        catch(Exception $e){
            $result = [
                'status' =>500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);
    }


    public function register(Request $request)
    {      
       
        $credentials = $request->only('');
        
        $validator = Validator::make($credentials, [
            'nome' => 'required|unique',
            'nome_social' => 'required|string|max:50',
            'razao_social' => 'required|string|max:50',
            'cnpj' => 'required|integer|max:12|unique', 
            'telefone' => 'required|integer|max:11',
            'email'    => 'required|string|email'
        ]);

        $user_id              = $request->input('user_id');
        $nome                 = $request->input('nome');
        $nome_social          = $request->input('nome_social');
        $razao_social         = $request->input('razao_social');
        $cnpj                 = $request->input('cnpj');
        $telefone             = $request->input('telefone');
        $email                = $request->input('email');
        $tipo_empresa_id      = $request->input('tipo_empresa_id');
        $natureza_empresa_id  = $request->input('natureza_empresa_id');
        $inscricao_empresa_id = $request->input('inscricao_empresa_id');
        
         try{
            $result['data'] =  $this->empresaService->register(
            $user_id,
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
            return response()->json(['message' => 'Empresa cadastrada com sucesso!']);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'não foi possível criar Empresa.',
            ],);
        }
    }

    public function update(Request $request, $id)
    {
        // Valide os dados recebidos do request, se necessário
        
        $request->validate([
            'nome' => 'required|unique',
            'nome_social' => 'required|string|max:50',
            'razao_social' => 'required|string|max:50',
            'cnpj' => 'required|integer|max:12', 
            'telefone' => 'required|integer|max:11',
            'email'    => 'required|string|email'
            // Adicione outras regras de validação conforme necessário
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
 
        try{
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
            return response()->json(['message' => 'Empresa atualizada com sucesso!']);
          }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy($id){
        $result = ['status' => 200];
        try{
            $result['data'] = $this->empresaService->deleteById($id);
            return response()->json(['message' => 'Empresa atualizada com sucesso!']);
        }catch(Exception $e){
           return response()->json([
                	'success' => false,
                	'message' => 'não foi possível deletar .',
                ], 500);
        }
    }
}
