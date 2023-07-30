<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'id' => '1',
            'user_id' => '1',
            'nome' => 'Minha Empresa',
            'nome_social' => 'Nome SOcial',
            'razao_social' => 'Razão SOcial',
            'endereco' => 'Meu endereço ',
            'cnpj' => '12345674',
            'email' => 'teste@gmail.com',
            'telefone' => '999999999',            
            // Adicione outros campos da empresa aqui
        ]);
    }
}
