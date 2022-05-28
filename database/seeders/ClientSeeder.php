<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => "Jaime",
           'surname' => "Serrano",
            'direction' => "mi casa",
            'phone' => "31433xxxxx",
            'email' => "micorreo@gmail.com"
        ]);

        DB::table('clients')->insert([
            'name' => "sebastia",
           'surname' => "Serrano",
            'direction' => "su casa",
            'phone' => "310xxxxxxx",
            'email' => "sucorreo@gmail.com"
        ]);
    }
}
