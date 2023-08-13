<?php

namespace Database\Seeders;

use App\Models\Permissao;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $usuario_padrao = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        
        DB::beginTransaction();
        try {     
            $user1 = User::create(array_merge([
                'email' => 'agt@gil.com',
                'name' => 'agostinh11', 
            ],$usuario_padrao));

            $user2 = User::create(array_merge([
                'email' => 'goset11@gail.com',
                'name' => 'agostinh12', 
            ],$usuario_padrao));

            $user3 = User::create(array_merge([
                'email' => 'gstts@gail.com',
                'name' => 'agostinh13', 
            ],$usuario_padrao));

            $role_agostinho = Role::create(['name' => 'agostinh11']);
            $role_agostinho2 = Role::create(['name' => 'agostinh12']);
            $role_agostinho3 = Role::create(['name' => 'agostinh13']);

            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);
            
            $user1->givePermissionTo('read role');
            $user1->givePermissionTo('create role');
            $user1->givePermissionTo('update role');
            $user1->givePermissionTo('delete role');

            DB::commit();
        } 
        catch (\Throwable $th)
        {   
            DB::rollBack();
        }
    }
}
