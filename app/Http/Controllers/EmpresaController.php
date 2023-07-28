<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
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
}
