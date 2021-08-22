<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'description' => 'AUTOMOVIL'
        ]);
        DB::table('tipos')->insert([
            'description' => 'CAMIONETA'
        ]);
        DB::table('tipos')->insert([
            'description' => 'TRANSPORTE PUBLICO'
        ]);
        DB::table('tipos')->insert([
            'description' => 'MAQUINARIA PESADA'
        ]);
    }
}