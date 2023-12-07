<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('model_has_roles')->delete();
    DB::table('roles')->delete();
      $role1 = Role::create(['name' => 'Admin']);
      $role2 = Role::create(['name' => 'Proveedor']); 


      Permission::create(['name' => 'register'])->syncRoles([$role1]);
      Permission::create(['name' => 'home'])->syncRoles([$role1, $role2]);
      Permission::create(['name' => 'equipos.index'])->syncRoles([$role1, $role2]);
      Permission::create(['name' => 'equipos.create'])->syncRoles([$role1]);
      Permission::create(['name' => 'equipos.edit'])->syncRoles([$role1]);
      Permission::create(['name' => 'equipos.destroy'])->syncRoles([$role1]);
      Permission::create(['name' => 'equipos.detalles'])->syncRoles([$role1, $role2]);
      Permission::create(['name' => 'equipos.historial'])->syncRoles([$role1, $role2]);

      Permission::create(['name' => 'impresoras.index'])->syncRoles([$role1, $role2]);
      Permission::create(['name' => 'impresoras.create'])->syncRoles([$role1]);
      Permission::create(['name' => 'impresoras.edit'])->syncRoles([$role1]);
      Permission::create(['name' => 'impresoras.destroy'])->syncRoles([$role1]);
      Permission::create(['name' => 'impresoras.historial'])->syncRoles([$role1, $role2]);

      Permission::create(['name' => 'celulares.index'])->syncRoles([$role1, $role2]);
      Permission::create(['name' => 'celulares.create'])->syncRoles([$role1]);
      Permission::create(['name' => 'celulares.edit'])->syncRoles([$role1]);
      Permission::create(['name' => 'celulares.destroy'])->syncRoles([$role1]);
      Permission::create(['name' => 'celulares.historial'])->syncRoles([$role1, $role2]);

      Permission::create(['name' => 'telefonos.index'])->syncRoles([$role1, $role2]);
      Permission::create(['name' => 'telefonos.create'])->syncRoles([$role1]);
      Permission::create(['name' => 'telefonos.edit'])->syncRoles([$role1]);
      Permission::create(['name' => 'telefonos.destroy'])->syncRoles([$role1]);
      Permission::create(['name' => 'telefonos.historial'])->syncRoles([$role1, $role2]);


      Permission::create(['name' => 'exportar.historial'])->syncRoles([$role1]);
      Permission::create(['name' => 'exportar.mantenimiento'])->syncRoles([$role1]);
      


       
    }
}
