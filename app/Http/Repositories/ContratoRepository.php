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
/*
    public function save($user_id, $nome, $nome_social, $razao_social, $cnpj, $telefone, $email, $tipo_empresa_id, $natureza_empresa_id, $inscricao_empresa_id, $status)
    {

        $contratos = new $this->contratos;
        $contratos->user_id = $user_id;
        $contratos->nome = $nome;
        $contratos->nome_social = $nome_social;
        $contratos->razao_social = $razao_social;
        $contratos->save();
        return $contratos->fresh();
    }

    public function update($id, $nome, $nome_social, $razao_social, $cnpj, $telefone, $email, $tipo_empresa_id, $natureza_empresa_id, $inscricao_empresa_id, $status)
    {
        $contratos = $this->contratos->find($id);
        $contratos->nome = $nome;
        $contratos->nome_social = $nome_social;
        $contratos->razao_social = $razao_social;
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
    */
}
