<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            // Grupo: Roles
            ['name' => 'ver-role', 'grupo' => 'ROLES'],
            ['name' => 'crear-role', 'grupo' => 'ROLES'],
            ['name' => 'editar-role', 'grupo' => 'ROLES'],
            ['name' => 'eliminar-role', 'grupo' => 'ROLES'],
            ['name' => 'restaurar-role', 'grupo' => 'ROLES'],

            // Grupo: User
            ['name' => 'ver-usuario', 'grupo' => 'USUARIOS'],
            ['name' => 'crear-usuario', 'grupo' => 'USUARIOS'],
            ['name' => 'editar-usuario', 'grupo' => 'USUARIOS'],
            ['name' => 'eliminar-usuario', 'grupo' => 'USUARIOS'],
            ['name' => 'restaurar-usuario', 'grupo' => 'USUARIOS'],

            // Grupo: Trucks
            ['name' => 'ver-camion', 'grupo' => 'CAMIONES'],
            ['name' => 'crear-camion', 'grupo' => 'CAMIONES'],
            ['name' => 'editar-camion', 'grupo' => 'CAMIONES'],
            ['name' => 'eliminar-camion', 'grupo' => 'CAMIONES'],
            ['name' => 'restaurar-camion', 'grupo' => 'CAMIONES'],

             // Grupo: Drivers
             ['name' => 'ver-conductor', 'grupo' => 'CONDUCTORES'],
             ['name' => 'crear-conductor', 'grupo' => 'CONDUCTORES'],
             ['name' => 'editar-conductor', 'grupo' => 'CONDUCTORES'],
             ['name' => 'eliminar-conductor', 'grupo' => 'CONDUCTORES'],
             ['name' => 'restaurar-conductor', 'grupo' => 'CONDUCTORES'],

            // Grupo: Orders
            ['name' => 'ver-ordenes', 'grupo' => 'ORDENES'],
            ['name' => 'ver-almacen', 'grupo' => 'ORDENES'],
            ['name' => 'ver-despacho', 'grupo' => 'ORDENES'],
            ['name' => 'ver-completado', 'grupo' => 'ORDENES'],
            ['name' => 'revertir-orden', 'grupo' => 'ORDENES'],

            // Grupo: Config
            ['name' => 'ver-log_Acceso', 'grupo' => 'ADMINISTRACIÓN'],
            ['name' => 'ver-dashboard', 'grupo' => 'ADMINISTRACIÓN'],
        ];

        foreach ($permisos as $permiso) {
            Permission::create([
                'name' => $permiso['name'],
                'grupo' => $permiso['grupo'],
            ]);
        }
    }
}
