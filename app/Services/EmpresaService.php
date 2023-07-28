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
}