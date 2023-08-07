<?php

namespace Database\Seeders;

use App\Models\Filial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            
        Filial::create([
            'nome_fantasia' => 'Nome Fantasia',
            'cnpj' => '12345674', 
            'ativo' => true,
            'inscricao_estadual' => '123456'
        ]);

        Filial::create([
            'nome' => 'Filial B',
            'endereco' => 'Avenida Secundária, 456',
            // ... outras colunas
        ]);
    }
}
