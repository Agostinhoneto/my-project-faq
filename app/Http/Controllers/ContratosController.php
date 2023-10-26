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
            return response()->json($result['data'], [Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function show($id)
    {
        try {
            if (empty($id)) {
                return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
            }
            $result['data'] = $this->contratoService->getById($id);
            return response()->json($result['data'], [Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }


    public function register(ContratoRequest $request)
    {
        $usuario_cadastrante_id = auth()->user();
        $valor                     = $request->input('valor');
        $data_inicio               = $request->input('data_inicio');
        $data_fim                  = $request->input('data_fim');
        $empresa_id                = $request->input('empresa_id');
        $status                    = $request->input('status');

        DB::beginTransaction();
        try {
            $result['data'] =  $this->contratoService->register(
                $valor,
                $data_inicio,
                $data_fim,
                $empresa_id,
                $usuario_cadastrante_id,
                $status
            );
            DB::commit();
            return response()->json($result['data'], [Messages::SAVE_MESSAGE, HttpStatusCodes::CREATED]);
        } catch (Exception $e) {
            DB::roolBack();
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function update(ContratoRequest $request, $id)
    {
        $id                        = $request->input('id');
        $usuario_modificante_id    = auth()->user();
        $valor                     = $request->input('valor');
        $data_inicio               = $request->input('data_inicio');
        $data_fim                  = $request->input('data_fim');
        $empresa_id                = $request->input('empresa_id');
        $status                    = $request->input('status');


        DB::beginTransaction();
        try {
            $result['data'] = $this->contratoService->update(
                $id,
                $valor,
                $data_inicio,
                $data_fim,
                $empresa_id,
                $usuario_modificante_id,
                $status
            );
            DB::commit();
            return response()->json($result['data'], [Messages::UPDATE_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function alterar_status($id,$status)
    {
        DB::beginTransaction();
        try {
            $contrato = Contratos::where('id', $id)->update(['status' => $status]); // entrar no services , e verificar a condição.
           // $result['data'] = $this->contratoService->deleteById($contrato);
            DB::commit();
            return response()->json($result['data'], [Messages::DELETE_MESSAGE, HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }
}
