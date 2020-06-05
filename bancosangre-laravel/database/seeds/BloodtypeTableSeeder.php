<?php

Use App\Bloodtype;
use Illuminate\Database\Seeder;

class BloodtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $type = new Bloodtype();
        $type->group = '0';
        $type->factor = '+';
        $type->save();    
        
        $type = new Bloodtype();
        $type->group = '0';
        $type->factor = '-';
        $type->save();  

        $type = new Bloodtype();
        $type->group = 'A';
        $type->factor = '+';
        $type->save();  

        $type = new Bloodtype();
        $type->group = 'A';
        $type->factor = '-';
        $type->save();  
        
    }
}
