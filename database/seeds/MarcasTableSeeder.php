<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert([
            'description' => 'RENAULT',
        ]);
        DB::table('marcas')->insert([
            'description' => 'CHEVROLET',
        ]);
        DB::table('marcas')->insert([
            'description' => 'MAZDA',
        ]);
        DB::table('marcas')->insert([
            'description' => 'NISSAN',
        ]);
        DB::table('marcas')->insert([
            'description' => 'KIA',
        ]);
        DB::table('marcas')->insert([
            'description' => 'TOYOTA',
        ]);
        DB::table('marcas')->insert([
            'description' => 'VOLKSWAGEN',
        ]);
        DB::table('marcas')->insert([
            'description' => 'SUZUKI',
        ]);
        DB::table('marcas')->insert([
            'description' => 'FORD',
        ]);
        DB::table('marcas')->insert([
            'description' => 'HYUNDAI'
        ]);
    }
}
