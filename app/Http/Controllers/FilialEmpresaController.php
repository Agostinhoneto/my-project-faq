<?php

namespace App\Http\Controllers;

use App\HttpStatusCodes;
use App\Services\FilialEmpresaService;
use Exception;
use Illuminate\Http\Request;

class FilialEmpresaController extends Controller
{
    
    public function __construct(private FilialEmpresaService $filialEmpresaService)
    {
        $this->filialEmpresaService = $filialEmpresaService;
        // $this->middleware('auth:api', ['except' => ['login','register','store']]);  
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
}
