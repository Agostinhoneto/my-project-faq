<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratosController extends Controller
{

    public function __construct(private ContratoService $contratoService)
    {
        $this->contratoService = $contratoService;
    }

}
