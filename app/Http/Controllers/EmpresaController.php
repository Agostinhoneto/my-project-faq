<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use App\Services\EmpresaService;
use App\HttpStatusCodes;
use App\Messages;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use PHPOpenSourceSaver\JWTAuth\JWTAuth as JWTAuthJWTAuth;

//use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
//use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class EmpresaController extends Controller
{

    public function __construct(private EmpresaService $empresaService)
    {
        $this->empresaService = $empresaService;
        //$this->middleware('auth:api', ['except' => ['login']]);  
    }

    public function index()
    {
        $limit = 10;
        try {
            $result['data'] = $this->empresaService->getAll($limit);
            return response()->json([Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function show($id)
    {
        try {
            if (!empty($id)) {
                $result['data'] = $this->empresaService->getById($id);
                return response()->json([Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK]);
            }
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }


    public function register(EmpresaRequest $request)
    {
            $user_id = FacadesJWTAuth::user();
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
            $status               = $request->input('status');
        DB::beginTransaction();
        try {
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
                $inscricao_empresa_id,
                $status
            );
            DB::commit();
            return response()->json([Messages::SAVE_MESSAGE, HttpStatusCodes::CREATED]);
        } catch (Exception $e) {
            dd($e);
            DB::roolBack();
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function update(EmpresaRequest $request, $id)
    {
        $id                    = $request->input('id');
        $nome                  = $request->input('nome');
        $nome_social           = $request->input('nome_social');
        $razao_social          = $request->input('razao_social');
        $cnpj                  = $request->input('cnpj');
        $telefone              = $request->input('telefone');
        $email                 = $request->input('email');
        $tipo_empresa_id       = $request->input('tipo_empresa_id');
        $natureza_empresa_id   = $request->input('natureza_empresa_id');
        $inscricao_empresa_id  = $request->input('inscricao_empresa_id');
        $status                = $request->input('status');


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
                $inscricao_empresa_id,
                $status
            );
            DB::commit();
            return response()->json([Messages::UPDATE_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function alterar_status($id)
    {
        DB::beginTransaction();
        try {
            $empresa = Empresa::where('id', $id)->update(['status' => 0]);
            $this->empresaService->deleteById($empresa);
            DB::commit();
            return response()->json([Messages::DELETE_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }
}
