<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilialEmpresaRequest;
use App\HttpStatusCodes;
use App\Messages;
use App\Models\FilialEmpresa;
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
        try {
            $result['data'] = $this->filialEmpresaService->getAll($limit);
            return response()->json([Messages::SUCCESS_MESSAGE,HttpStatusCodes::OK]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $result['data'] = $this->filialEmpresaService->getById($id);
            return response()->json([Messages::SUCCESS_MESSAGE,HttpStatusCodes::OK]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }



    public function register(FilialEmpresaRequest $request)
    {

        $dados = [
            $empresa_id          = $request->input('empresa_id'),
            $nome_fantasia       = $request->input('nome_fantasia'),
            $cnpj                = $request->input('cnpj'),
            $telefone            = $request->input('telefone'),
            $status              = $request->input('status'),
            $inscricao_estadual  = $request->input('inscricao_estadual'),
        ];
        DB::beginTransaction();
        try {
            $dados['data'] =  $this->filialEmpresaService->register(
                $empresa_id,
                $nome_fantasia,
                $cnpj,
                $telefone,
                $status,
                $inscricao_estadual
            );
            DB::commit();
            return response()->json([Messages::SAVE_MESSAGE,HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            Log::error($e->getMessage());
        }
    }


    public function update(FilialEmpresaRequest $request, $id)
    {
        $dados = [
            $empresa_id          = $request->input('empresa_id'),
            $nome_fantasia       = $request->input('nome_fantasia'),
            $cnpj                = $request->input('cnpj'),
            $telefone            = $request->input('telefone'),
            $status              = $request->input('status'),
            $inscricao_estadual  = $request->input('inscricao_estadual'),
        ];
        DB::beginTransaction();
        try {
            $dados['data'] =  $this->filialEmpresaService->register(
                $empresa_id,
                $nome_fantasia,
                $cnpj,
                $telefone,
                $status,
                $inscricao_estadual
            );

            DB::commit();
            return response()->json([Messages::UPDATE_MESSAGE,HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            Log::error($e->getMessage());
        }
    }

    public function alterar_status($id,$status)
    {
        DB::beginTransaction();
        try {
            $filial = FilialEmpresa::where('id', $id)->update(['status' => $status]);
            $this->filialEmpresaService->deleteById($filial);
            DB::commit();
            return response()->json([Messages::DELETE_MESSAGE,HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            Log::error($e->getMessage());
        }
    }
}
