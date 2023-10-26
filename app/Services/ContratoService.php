<?php

namespace App\Services;

use App\Http\Repositories\ContratoRepository;
use App\Http\Repositories\EmpresaRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class ContratoService
{
    protected $contratoRepository;

    public function __construct(ContratoRepository $contratoRepository)
    {
        $this->contratoRepository = $contratoRepository;
    }

    public function getAll($limit = 10)
    {
        return $this->contratoRepository->getAll($limit);
    }

    public function getById($id)
    {
        return $this->contratoRepository
            ->getById($id);
    }

    public function register($valor,$data_inicio, $data_fim,$usuario_cadastrante_id,$empresa_id,$status)
    {
        $result = $this->contratoRepository
            ->save($valor,$data_inicio, $data_fim, $usuario_cadastrante_id,$empresa_id,$status);
        return $result;
    }

    public function update($id,$valor,$data_inicio,$data_fim,$usuario_modificante_id,$empresa_id,$status)
    {
        $result = $this->contratoRepository
           ->update($id,$valor,$data_inicio, $data_fim, $usuario_modificante_id,$empresa_id,$status);
        return $result;
    }

    public function deleteById($id)
    {
        $contrato = $this->contratoRepository->alterar_status($id);
        return $contrato;
    }

}
