<?php

namespace App\Http\Controllers;

use App\HttpStatusCodes;
use App\Messages;
use App\Models\Contratos;
use Illuminate\Http\Request;

class ContratosController extends Controller
{

    public function __construct(private ContratoService $contratoService)
    {
        $this->contratoService = $contratoService;
    }


    public function index()
    {
        $limit = 10;
        try {
            $result['data'] = $this->contratoService->getAll($limit);
            return response()->json($result['data'],[Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
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
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }


    public function register(ContratoRequest $request)
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
            $result['data'] =  $this->contratoService->register(
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
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function update(ContratoRequest $request, $id)
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
            $result['data'] = $this->contratoService->update(
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
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function alterar_status($id)
    {
        DB::beginTransaction();
        try {
            $contrato = Contratos::where('id', $id)->update(['status' => 0]);
            $result['data'] = $this->contratoService->deleteById($contrato);
            DB::commit();
            return response()->json($result['data'],[Messages::DELETE_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }
   // $valor,$data_inicio, $data_fim, $usuario_cadastrante_id,$empresa_id

}
