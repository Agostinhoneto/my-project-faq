<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use App\Services\EmpresaService;

class EmpresaController extends Controller
{
 
    public function __construct(private EmpresaService $empresaService)
    {
       // $this->middleware('auth:api', ['except' => ['login','register','store']]);  
    }

    public function index()
    {
        $result = ['status' => 200];
        
        try{
            $result['data'] = $this->empresaService->getAll(); 
        }   
        catch(Exception $e){
            $result = [
                'status' => 500,
                'error' =>$e->getMessage()
            ];
        }
        return response()->json($result,$result['status']);     
    }

    public function register(Request $request)
    {      
       
        $credentials = $request->only('', 'password');
        
        $validator = Validator::make($credentials, [
            'nome' => 'required|unique',
            'nome_social' => 'required|string|max:50',
            'razao_social' => 'required|string|max:50',
            'endereco' => 'required|string|max:50',
            'cnpj' => 'required|integer|max:12', 
            'telefone' => 'required|integer|max:11',
            'email'    => 'required|string|email'
        ]);
      //  $user_id         = $request->input('user_id'); 
        $id              = $request->input('id');
        $user_id         = $request->input('user_id');
        $nome            = $request->input('nome');
        $nome_social     = $request->input('nome_social');
        $razao_social    = $request->input('razao_social');
        $endereco        = $request->input('endereco');
        $cnpj            = $request->input('cnpj');
        $telefone        = $request->input('telefone');
        $email           = $request->input('email');
         try{
            $result['data'] =  $this->empresaService->register(
            $id,
            $user_id,
            $nome,
            $nome_social, 
            $razao_social,
            $endereco,
            $cnpj,
            $telefone,
            $email
            );
        }catch(Exception $e){
            dd($e);
            return response()->json([
                'success' => false,
                'message' => 'não foi possível criar Empresa.',
            ], 500);
        }
        return response()->json($result,$result['status']);
    }

}
