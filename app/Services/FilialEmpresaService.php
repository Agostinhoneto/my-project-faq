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

    public function register($user_id, $nome, $nome_social, $razao_social, $cnpj, $telefone, $email, $tipo_empresa_id, $natureza_empresa_id, $inscricao_empresa_id)
    {
        $result = $this->filialEmpresaRepository
            ->save($user_id, $nome, $nome_social, $razao_social, $cnpj, $telefone, $email, $tipo_empresa_id, $natureza_empresa_id, $inscricao_empresa_id);
        return $result;
    }

    public function update($id, $nome, $nome_social, $razao_social, $cnpj, $telefone, $email, $tipo_empresa_id, $natureza_empresa_id, $inscricao_empresa_id)
    {
        $result = $this->filialEmpresaRepository
            ->update($id, $nome, $nome_social, $razao_social, $cnpj, $telefone, $email, $tipo_empresa_id, $natureza_empresa_id, $inscricao_empresa_id);
        return $result;
    }

    public function deleteById($id)
    {
        $empresa = $this->filialEmpresaRepository->delete($id);
        return $empresa;
    }
}
