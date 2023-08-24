<?php

namespace Database\Seeders;

use App\Models\InscricaoSociais;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InscricaoSociaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InscricaoSociais::create([
            'id' => 1,
            
        ]);

        InscricaoSociais::create([
            'id' => 2
        ]);
    }
}
