<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['nome' => 'São Paulo', 'sigla' => 'SP'],
            ['nome' => 'Rio de Janeiro', 'sigla' => 'RJ'],
            ['nome' => 'Minas Gerais', 'sigla' => 'MG'],
            // Adicione mais estados conforme necessário
        ];

        Estado::insert($estados);

    }
}
