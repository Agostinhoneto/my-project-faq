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
        return $this->filialEmpresaRepository->getAllEmpresa($limit);
    }
}  