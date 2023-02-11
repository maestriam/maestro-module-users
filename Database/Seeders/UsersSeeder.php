<?php

namespace Maestro\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Maestro\Users\Support\Concerns\StoresUsers;

class UsersSeeder extends Seeder
{
    use StoresUsers;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
    }
}
