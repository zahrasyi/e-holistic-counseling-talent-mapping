<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * table master
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'bismillah',
            ]
        );
        $this->call(RolesAndPermissionsSeeder::class);

        // admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $admin->assignRole('admin');

        // superadmin
        $superadmin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $superadmin->assignRole('super admin');

        // konselor
        $konselor1 = User::create([
            'name' => 'Dr. Budi Santoso, S.Psi., M.Psi.',
            'email' => 'konselor1@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $konselor1->assignRole('konselor');
        $konselor1->specializations()->attach([1, 5]);

        $konselor2 = User::create([
            'name' => 'Dra. Rina Indriani, M.Psi.',
            'email' => 'konselor2@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $konselor2->assignRole('konselor');
        $konselor2->specializations()->attach([2, 3]);

        $konselor3 = User::create([
            'name' => 'Ahmad Zulkifli, S.Psi.',
            'email' => 'konselor3@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $konselor3->assignRole('konselor');
        $konselor3->specializations()->attach([2, 4]);

        // mahasiswa
        // $mahasiswa = User::factory(10)->create();
        // $mahasiswa->each(function ($user) {
        //     $user->assignRole('mahasiswa');
        // });

        $mahasiswa1 = User::create([
            'name' => 'Mahasiswa 1',
            'email' => 'mahasiswa1@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $mahasiswa1->assignRole('mahasiswa');

        $mahasiswa2 = User::create([
            'name' => 'Mahasiswa 2',
            'email' => 'mahasiswa2@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $mahasiswa2->assignRole('mahasiswa');

        $mahasiswa3 = User::create([
            'name' => 'Mahasiswa 3',
            'email' => 'mahasiswa3@mail.com',
            'password' => Hash::make('test123'),
        ]);
        $mahasiswa3->assignRole('mahasiswa');
    }
}
