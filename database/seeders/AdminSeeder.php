<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =  User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),

        ]);

        $customer =  User::create([
            'name' => 'Customer',
            'email' => 'customer@admin.com',
            'password' => bcrypt('password'),

        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);


        $role = Role::create(['name' => 'Customer']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $customer->assignRole([$role->id]);



    }
}
