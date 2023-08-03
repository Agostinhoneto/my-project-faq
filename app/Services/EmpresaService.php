<?php
namespace App\Services;
use App\Http\Repositories\EmpresaRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class EmpresaService {
    
    protected $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepository)
    {
        $this->empresaRepository = $empresaRepository;
    }
    
    public function getAll($limit = 10){
        return $this->empresaRepository->getAllEmpresa($limit);
    }

    public function getById($id){
        return $this->empresaRepository
        ->getById($id);
    }

    public function register($user_id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id)
    {
        DB::beginTransaction();
        try{
        DB::commit();
            $result = $this->empresaRepository
            ->save($user_id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id);
        }
        catch(Exception $e){
            DB::roolBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não pode ser criado');
        }
        return $result;
    }

    public function update($id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id)
    {
        DB::beginTransaction();
        try{
            DB::commit();
            $result = $this->empresaRepository
            ->update($id,$nome,$nome_social,$razao_social,$cnpj,$telefone,$email,$tipo_empresa_id,$natureza_empresa_id,$inscricao_empresa_id);
        }    
        catch(Exception $e){
            DB::roolBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não pode ser atualizado');
        }
        return $result;
    }

    public function deleteById($id){
        DB::beginTransaction();
        try{
            DB::commit();
            $empresa = $this->empresaRepository->delete($id);
        }
        catch(Exception $e){
            DB::roolBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não pode ser deletado');
        }
        return $empresa;
    }
}