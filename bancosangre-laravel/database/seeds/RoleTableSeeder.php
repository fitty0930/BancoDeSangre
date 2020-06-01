<?php

use App\Role; // NO ENCUENTRA ESTOO
use App\User;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();       
        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();
        
    }
}
