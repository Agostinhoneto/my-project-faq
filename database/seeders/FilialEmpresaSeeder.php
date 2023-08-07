<?php

namespace Database\Seeders;

use App\Models\FilialEmpresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilialEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            
        FilialEmpresa::create([
            'empresa_id' => 1,
            'nome_fantasia' => 'Nome Fantasia',
            'cnpj' => '12345674', 
            'telefone' => '12345674', 
            'ativo' => true,
            'inscricao_estadual' => '123456'
        ]);

        FilialEmpresa::create([
            'empresa_id' => 1,
            'nome_fantasia' => 'Nome Fantasia',
            'cnpj' => '12345674', 
            'telefone' => '12345674',
            'ativo' => true,
            'inscricao_estadual' => '123456'
        ]);
    }
}
