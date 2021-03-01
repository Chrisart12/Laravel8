<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['firstname' => 'Ali', 'lastname' => 'Kodjo', 'email' => 'ali@gmail.com', 'password' => bcrypt(11111111)],
            ['firstname' => 'Momo', 'lastname' => 'Mouloud', 'email' => 'momo@gmail.com', 'password' => bcrypt(11111111)],
            ['firstname' => 'Toto', 'lastname' => 'Poid', 'email' => 'toto@gmail.com', 'password' => bcrypt(11111111)],
            ['firstname' => 'Titi', 'lastname' => 'Joie', 'email' => 'titi@gmail.com', 'password' => bcrypt(11111111)],
        ]);

    }
}
