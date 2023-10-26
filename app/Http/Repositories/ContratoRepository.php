<?php

namespace App\Http\Repositories;

use App\Models\Contratos;
use App\Models\Empresa;
use Illuminate\Http\Request;


class ContratoRepository
{
    protected $contratos;

    public function __construct(Contratos $contratos)
    {
        $this->contratos = $contratos;
    }

    public function getAll($limit)
    {
        return Contratos::paginate($limit);
    }

    public function getById($id)
    {
        return Contratos::findOrFail($id);
    }

    public function save($valor,$data_inicio, $data_fim, $usuario_cadastrante_id,$empresa_id, $status)
    {

        $contratos = new $this->contratos;
        $contratos->valor = $valor;
        $contratos->data_inicio = $data_inicio;
        $contratos->data_fim = $data_fim;
        $contratos->usuario_cadastrante_id = $usuario_cadastrante_id;
        $contratos->empresa_id = $empresa_id;
        $contratos->save();
        return $contratos->fresh();
    }

    public function update($id, $valor,$data_inicio, $data_fim, $usuario_modificante_id,$empresa_id, $status)
    {
        $contratos = $this->contratos->find($id);
        $contratos->valor = $valor;
        $contratos->data_inicio = $data_inicio;
        $contratos->data_fim = $data_fim;
        $contratos->usuario_modificante_id = $usuario_modificante_id;
        $contratos->empresa_id = $empresa_id;
        $contratos->update();

        return $contratos->fresh();
    }

    public function alterar_status($id)
    {
        if ($id != null) {
            $contratos = $this->contratos->findOrFail($id);
            $contratos->update();
        }
        return $contratos;
    }
}
