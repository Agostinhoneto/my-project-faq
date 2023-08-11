<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilialEmpresaRequest;
use App\HttpStatusCodes;
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
            return response()->json([
                'message' => 'Dados retornados com Sucesso',
            ], HttpStatusCodes::OK, $result);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar trazer os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $result['data'] = $this->filialEmpresaService->getById($id);
            return response()->json(['message' => 'Retorno do valor com sucesso!', HttpStatusCodes::OK, $result]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar trazer os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
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
            return response()->json(['message' => 'Filial criada com sucesso!', HttpStatusCodes::CREATED]);
        } catch (Exception $e) {
            dd($e);
            DB::roolBack();
            return response()->json([
                'message' => 'Erro ao criar os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
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
            return response()->json(['message' => 'Empresa atualizada com sucesso!', HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            return response()->json([
                'message' => 'Erro ao atualizar os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }

    public function alterar_status($id)
    {
        DB::beginTransaction();
        try {            
            $filial = FilialEmpresa::where('id', $id)->update(['status' => 0]);
            $this->filialEmpresaService->deleteById($filial);
            DB::commit();
            return response()->json(['message' => 'Empresa Deletado com sucesso!', HttpStatusCodes::OK]);
        } catch (Exception $e) {
            DB::roolBack();
            dd($e);
            return response()->json([
                'message' => 'Erro ao deletar os Dados',
            ], HttpStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }
}
