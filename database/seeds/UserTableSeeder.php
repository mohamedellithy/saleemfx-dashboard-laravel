<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0;$i<50;$i++){
            factory(App\User::class)->create();
        }

        App\User::create([
          'firstname'=>'admin',
          'lastname'=>'admin',
          'username'=>'admin',
          'email'=>'admin@admin.com',
          'role'=>1,
          'phone'=>'0000000000',
          'password'=>Hash::make('password')
        ]);

    }
}
