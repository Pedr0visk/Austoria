<?php

use Illuminate\Database\Seeder;
use Maklad\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('maklad.permission.cache');

        // Permission for sale
        Permission::create(['name' => 'all', 'guard_name' => 'web']);
        Permission::create(['name' => 'create sale', 'guard_name' => 'web']);
        Permission::create(['name' => 'read sale', 'guard_name' => 'web']);
        Permission::create(['name' => 'update sale', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete sale', 'guard_name' => 'web']);
    }
}
