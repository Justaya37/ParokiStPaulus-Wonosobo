<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Roles
        $roles = [
            [
                'name' => 'admin_sekretariat',
                'display_name' => 'Admin Sekretariat',
                'deskripsi' => 'Pengelola administrasi umum, pengguna, jadwal peribadatan, dan data master paroki.',
            ],
            [
                'name' => 'romo_paroki',
                'display_name' => 'Romo Paroki',
                'deskripsi' => 'Imam paroki pembimbing rohani, pengelola sapaan renungan, dan pengawas data master.',
            ],
            [
                'name' => 'tim_komsos',
                'display_name' => 'Tim Komsos / OMK',
                'deskripsi' => 'Pengelola publikasi media warta berita, dokumentasi, dan galeri paroki.',
            ],
            [
                'name' => 'guest',
                'display_name' => 'Guest / Umat Umum',
                'deskripsi' => 'Umat dan publik umum yang mengakses informasi publik (Read-Only tanpa login).',
            ],
        ];

        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r['name']], $r);
        }

        $adminRole = Role::where('name', 'admin_sekretariat')->first();
        $romoRole = Role::where('name', 'romo_paroki')->first();
        $komsosRole = Role::where('name', 'tim_komsos')->first();

        // 2. Seed Initial Administrative Accounts
        // Password can be overridden via environment variables for security in production
        $defaultPassword = env('INITIAL_APP_PASSWORD', 'ParokiWonosobo2026!');

        User::firstOrCreate(
            ['email' => 'admin@parokiwonosobo.org'],
            [
                'role_id' => $adminRole->id,
                'name' => 'Sekretariat Paroki St. Paulus',
                'password' => Hash::make($defaultPassword),
                'no_hp' => '081234567890',
                'status_aktif' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'romo@parokiwonosobo.org'],
            [
                'role_id' => $romoRole->id,
                'name' => 'Romo Paroki Santo Paulus',
                'password' => Hash::make($defaultPassword),
                'no_hp' => '081234567891',
                'status_aktif' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'komsos@parokiwonosobo.org'],
            [
                'role_id' => $komsosRole->id,
                'name' => 'Tim Komsos & OMK Wonosobo',
                'password' => Hash::make($defaultPassword),
                'no_hp' => '081234567892',
                'status_aktif' => true,
            ]
        );
    }
}

