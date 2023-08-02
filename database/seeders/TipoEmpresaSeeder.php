<?php

namespace Database\Seeders;

use App\Models\TipoEmpresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoEmpresa::create([
            'descricao' => 'MEI - Microempreendedor Individual',
        ]);

        TipoEmpresa::create([
            'descricao' => 'ME - Microempresa',
        ]);

        TipoEmpresa::create([
            'descricao' => 'EPP - Empresa de Pequeno Porte',
        ]);
    }
}
