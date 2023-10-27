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

class EmpresaController extends Controller
{

    public function __construct(private EmpresaService $empresaService)
    {
        $this->empresaService = $empresaService;
    }

    public function index()
    {
        $limit = 10;
        try {
            $result['data'] = $this->empresaService->getAll($limit);
            return response()->json($result['data'],[Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            if (!empty($id)) {
                $result['data'] = $this->empresaService->getById($id);
                return response()->json($result['data'],[Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK]);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }


    public function register(EmpresaRequest $request)
    {
        $user = auth()->user();
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
            return response()->json($result['data'],[Messages::SAVE_MESSAGE, HttpStatusCodes::CREATED]);
        } catch (Exception $e) {
            DB::roolBack();
            Log::error($e->getMessage());
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
            return response()->json($result['data'],[Messages::UPDATE_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            Log::error($e->getMessage());
        }
    }

    public function alterar_status($id,$status)
    {
        DB::beginTransaction();
        try {
            $empresa = Empresa::where('id', $id)->update(['status' => $status]); // services
            $result['data'] = $this->empresaService->deleteById($empresa);
            DB::commit();
            return response()->json($result['data'],[Messages::DELETE_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            Log::error($e->getMessage());
        }
    }
}
