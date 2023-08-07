<?php

namespace App\Services;

use App\Http\Repositories\FilialRepository;

class FilialService
{
    protected $filialRepository;

    public function __construct(FilialRepository $filialRepository)
    {
        $this->filialRepository = $filialRepository;
    }

    public function getAll($limit = 10)
    {
        return $this->filialRepository->getAllEmpresa($limit);
    }
}  