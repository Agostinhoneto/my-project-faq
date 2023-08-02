<?php

namespace Database\Seeders;

use App\Models\NaturezaEmpresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NaturezaEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NaturezaEmpresa::create([
            'descricao' => 'Comércio',
        ]);

        NaturezaEmpresa::create([
            'descricao' => 'Indústria',
        ]);

        NaturezaEmpresa::create([
            'descricao' => 'Serviços',
        ]);
    }
}
