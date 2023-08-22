<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Inscricao_social;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

      // $this->call([UserRolePermissionSeeder::class]);
     
     // $this->call([UserSeeder::class]);
      //$this->call(NaturezaEmpresaSeeder::class);
      $this->call(TipoEmpresaSeeder::class);
     // $this->call(InscricaoSociaisSeeder::class);
      //$this->call([EmpresaSeeder::class]);
     // $this->call(EnderecosTableSeeder::class);
      //$this->call(EstadosTableSeeder::class);
      //$this->call(CidadesTableSeeder::class);

       // $this->call([Admin::class]);
    }
}

