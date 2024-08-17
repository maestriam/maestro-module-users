<?php

namespace Maestro\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Maestro\Users\Support\Users;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'admin';
        
        Users::creator()->create([
            'firstName'             => 'Maestro',
            'lastName'              => 'Admin',
            'accountName'           => 'admin',
            'email'                 => 'admin@admin',
            'password'              => $password, 
            'password_confirmation' => $password
        ]);
    }
}
