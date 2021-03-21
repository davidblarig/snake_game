<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThematicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('thematics_snake')->insert([
            'id' => '1',
            'type' => 'Mundo',
            'name' => 'Normal',
            'description' => 'Nivel inicial',
            'background' => 'theme1.jpg',
            'snake_color' => 'Verde'
        ]);
  
        DB::table('thematics_snake')->insert([
            'id' => '2',
            'type' => 'Mundo',
            'name' => 'Desierto',
            'description' => 'Mundo del desierto',
            'background' => 'desert.png',
            'snake_color' => 'Rojo'
        ]);
        DB::table('thematics_snake')->insert([
            'id' => '3',
            'type' => 'Mapa',
            'name' => 'Almería',
            'description' => 'Mapa de Almería',
            'background' => 'almeria.jpg',
            'snake_color' => 'Azul'
        ]);
      
    }
}
