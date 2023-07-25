<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'nome' => 'Minha Empresa',
            'cnpj' => '12345678901234',
            // Adicione outros campos da empresa aqui
        ]);
    }
}
