<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Permission::truncate();
        Permission::create(['name' => 'Listar posts']);
        Permission::create(['name' => 'Crear posts']);
        Permission::create(['name' => 'Actualizar posts']);
        Permission::create(['name' => 'Eliminar posts']);
        Permission::create(['name' => 'Listar usuarios']);
        Permission::create(['name' => 'Crear usuarios']);
        Permission::create(['name' => 'Actualizar usuarios']);
        Permission::create(['name' => 'Eliminar usuarios']);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
