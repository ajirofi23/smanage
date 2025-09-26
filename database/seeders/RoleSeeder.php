<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
{
    $roles = ['administrator', 'manager', 'supervisor', 'employee'];

    foreach ($roles as $role) {
        DB::table('roles')->updateOrInsert(
            ['name' => $role], // cek berdasarkan name
            ['name' => $role]  // kalau belum ada, insert
        );
    }
}

}
