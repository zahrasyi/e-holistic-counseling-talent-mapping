<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // permission
        Permission::firstOrCreate(['name' => 'view konseling']);
        Permission::firstOrCreate(['name' => 'create konseling']);
        Permission::firstOrCreate(['name' => 'edit konseling']);
        Permission::firstOrCreate(['name' => 'delete konseling']);

        Permission::firstOrCreate(['name' => 'view users']);
        Permission::firstOrCreate(['name' => 'create users']);
        Permission::firstOrCreate(['name' => 'edit users']);
        Permission::firstOrCreate(['name' => 'delete users']);

        $superAdmin = Role::firstOrCreate(['name' => 'super admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $mahasiswa = Role::firstOrCreate(['name' => 'mahasiswa']);
        $mahasiswa->givePermissionTo(['view konseling', 'create konseling', 'edit konseling', 'delete konseling']);

        $konselor = Role::firstOrCreate(['name' => 'konselor']);
        $konselor->givePermissionTo(['view konseling', 'create konseling', 'edit konseling', 'delete konseling']);
    }
}
