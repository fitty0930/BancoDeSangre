<?php

use App\Role; // NO ENCUENTRA ESTO
use App\User;
use App\Bloodtype;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // La creación de datos de roles debe ejecutarse primero
        $this->call(BloodtypeTableSeeder::class);
        $this->call(RoleTableSeeder::class);    // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
    }
}
