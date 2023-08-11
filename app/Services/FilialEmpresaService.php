<?php

namespace App\Services;

use App\Http\Repositories\FilialEmpresaRepository;

class FilialEmpresaService
{
    protected $filialEmpresaRepository;

    public function __construct(FilialEmpresaRepository $filialEmpresaRepository)
    {
        $this->filialEmpresaRepository = $filialEmpresaRepository;
    }

    public function getAll($limit = 10)
    {
        return $this->filialEmpresaRepository->getAll($limit);
    }

    public function getById($id)
    {
        return $this->filialEmpresaRepository
            ->getById($id);
    }

    public function register($empresa_id,$nome_fantasia,$cnpj,$telefone,$status,$inscricao_estadual)
    {
        $result = $this->filialEmpresaRepository
            ->save($empresa_id,$nome_fantasia,$cnpj,$telefone,$status,$inscricao_estadual);
         return $result;
    }

    public function update($id,$empresa_id,$nome_fantasia,$cnpj,$telefone,$status,$inscricao_estadual)
    {
        $result = $this->filialEmpresaRepository
            ->update($id,$empresa_id,$nome_fantasia,$cnpj,$telefone,$status,$inscricao_estadual);
        return $result;
    }

    public function deleteById($id)
    {
        $filialempresa = $this->filialEmpresaRepository->alterar_status($id);
        return $filialempresa;
    }
}
