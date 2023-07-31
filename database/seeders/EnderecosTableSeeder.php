<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnderecosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Endereco::create([
            'empresa_id' => '1',
            'logradouro' => 'Rua Exemplo 1',
            'numero' => '123',
            'bairro' => 'Bairro Exemplo',
            'cidade' => 'Cidade Exemplo',
            'estado' => 'Estado Exemplo',
            'cep' => '12345-678',
        ]);

        Endereco::create([
            'empresa_id' => '2', 
            'logradouro' => 'Rua Exemplo 2',
            'numero' => '456',
            'bairro' => 'Bairro Exemplo',
            'cidade' => 'Cidade Exemplo',
            'estado' => 'Estado Exemplo',
            'cep' => '98765-432',
        ]);
    }
}
