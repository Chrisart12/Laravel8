<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PayUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pay_user')->insert([
            ['pay_id' => 1, 'user_id' => 1],
            ['pay_id' => 2, 'user_id' => 1],
            ['pay_id' => 3, 'user_id' => 1],
            ['pay_id' => 4, 'user_id' => 2],
            ['pay_id' => 5, 'user_id' => 2],
            ['pay_id' => 1, 'user_id' => 1],
            ['pay_id' => 1, 'user_id' => 1],
            ['pay_id' => 8, 'user_id' => 1],
        ]);
    }
}
