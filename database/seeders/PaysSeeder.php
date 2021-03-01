<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pays')->insert([
            ['slug' => 'france', 'label' => 'France'],
            ['slug' => 'mali', 'label' => 'Mali'],
            ['slug' => 'belgique', 'label' => 'Belgique'],
            ['slug' => 'senegal', 'label' => 'Senegal'],
            ['slug' => 'togo', 'label' => 'Togo'],
            ['slug' => 'benin', 'label' => 'Bénin'],
            ['slug' => 'ghana', 'label' => 'Ghana'],
            ['slug' => 'niger', 'label' => 'Niger'],
            ['slug' => 'nigeria', 'label' => 'Nigéria'],
            ['slug' => 'allemagne', 'label' => 'Allemagne'],
            ['slug' => 'maroc', 'label' => 'Maroc'],
        ]);

    }
}
