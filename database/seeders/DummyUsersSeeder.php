<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
        [
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role_id' => 1, // Administrator role ID    
            'password' => bcrypt ('P@ssw0rd123*')
        ],

          [
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'role_id' => 2, // Administrator role ID    
            'password' => bcrypt ('P@ssw0rd123*')
        ],
        [
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            'role_id' => 3, // Administrator role ID    
            'password' => bcrypt ('P@ssw0rd123*')
        ],

        [
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'role_id' => 4, // Administrator role ID    
            'password' => bcrypt ('P@ssw0rd123*')
        ],
    ];

    foreach ($userData as $key => $val) {
        User::create($val);
        }
    }
        
    }