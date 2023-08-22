<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user_list = Permission::create(['name'=>'users.list', 'guard_name'=>'web']);
        $user_view = Permission::create(['name'=>'users.view','guard_name'=>'web']);
        $user_create = Permission::create(['name'=>'users.create','guard_name'=>'web']);
        $user_update = Permission::create(['name'=>'users.update','guard_name'=>'web']);
        $user_delete = Permission::create(['name'=>'users.delete','guard_name'=>'web']);

        $admin_role = Role::create(['name' =>'admin','guard_name'=>'web']); 
       
        $admin_role->givePermissionTo([
            $user_create,
            $user_list,
            $user_update,
            $user_view,
            $user_delete
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $user_create,
            $user_list,
            $user_update,
            $user_view,
            $user_delete        
        ]);
        $user = User::create([
            'name' => 'Usuario',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
        $user_role = Role::create(['name' => 'usuario']); 
       
        $user->assignRole($user_role);
 
        $user->givePermissionTo([
            $user_list,
        ]);

        $user_role->givePermissionTo([
            $user_list,
        ]);
      
    }
}
