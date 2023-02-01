<?php

namespace Maestro\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Maestro\Users\Support\Facade\Users;
use Illuminate\Database\Eloquent\Model;
use Maestro\Users\Support\Concerns\StoresUsers;

class UserSeeder extends Seeder
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
