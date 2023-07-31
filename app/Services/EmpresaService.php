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

    public function getAll(){
        return $this->empresaRepository
        ->getAllEmpresa();
    }

    public function register($user_id,$nome,$nome_social,$razao_social,$endereco,$cnpj,$telefone,$email)
    {
        $result = $this->empresaRepository
        ->save($user_id,$nome,$nome_social,$razao_social,$endereco,$cnpj,$telefone,$email);
        return $result;
    }

    public function update($id,$nome,$nome_social,$razao_social,$endereco,$cnpj,$telefone,$email)
    {
        $result = $this->empresaRepository
        ->update($id,$nome,$nome_social,$razao_social,$endereco,$cnpj,$telefone,$email);
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