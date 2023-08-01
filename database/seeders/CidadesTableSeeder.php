<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cidades = [
            ['nome' => 'São Paulo', 'estado_id' => 1], // Estado de São Paulo tem ID 1
            ['nome' => 'Rio de Janeiro', 'estado_id' => 2], // Estado do Rio de Janeiro tem ID 2
            ['nome' => 'Belo Horizonte', 'estado_id' => 3], // Estado de Minas Gerais tem ID 3
            // Adicione mais cidades conforme necessário
        ];

        Cidade::insert($cidades);
    }
}
