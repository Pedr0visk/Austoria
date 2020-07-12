<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create role admin
        $role = Role::where('name', 'admin')->first();

        if (!$role) {
            $role = Role::create([
                'name' => 'admin',
            ]);

            $role->givePermissionTo('all');
        }

        // create role user
        $role = Role::where('name', 'user')->first();

        if (!$role) {
            $role = Role::create([
                'name' => 'user',
            ]);

            $role->givePermissionTo('create sales');
            $role->givePermissionTo('read sales');
            $role->givePermissionTo('update sales');
            $role->givePermissionTo('delete sales');
        }
    }
}
