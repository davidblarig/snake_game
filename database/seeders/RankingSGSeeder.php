<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankingSGSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranking_snake')->insert([
            'id' => '1',
            'name'=> 'AAA',
            'score' => '500',
            'date' => '2021/02/12',
            'mode' => '1',
        ]);
  
        DB::table('ranking_snake')->insert([
            'id' => '2',
            'name'=> 'BBB',
            'score' => '1000',
            'date' => '2021/01/24',
            'mode' => '1',
        ]);
  
        DB::table('ranking_snake')->insert([
            'id' => '3',
            'name'=> 'CCC',
            'score' => '850',
            'date' => '2021/03/15',
            'mode' => '2',
        ]);
    }
}
