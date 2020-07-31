<?php

use Illuminate\Database\Seeder;
use App\Material;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            'group_id' => 1,
            'main_word' => 'can',
            'english'=> 'I can break an egg in the blink of an eye',
            'japanese'=> '私は瞬きで卵を割ることができます。',
            'photo'=> 'hannah-tasker-ZBkH8G4_yyE-unsplash.jpg'
        ]);
        
        DB::table('materials')->insert([
            'group_id' => 1,
            'main_word' => 'can',
            'english'=> "I can't close my armpit",
            'japanese'=> '私は、脇を閉められません。',
            'photo'=> 'ben-white-lVCHfXn3VME-unsplash.jpg'
        ]);
        
        DB::table('materials')->insert([
            'group_id' => 1,
            'main_word' => 'make',
            'english'=> 'How to make Anpanman',
            'japanese'=> 'アンパンマンの作り方。',
            'photo'=> 'jason-rosewell--iAgKHaNUqI-unsplash.jpg'
        ]);
        
        DB::table('materials')->insert([
            'group_id' => 1,
            'main_word' => 'eat',
            'english'=> 'Walnuts are delicious to eat with their shells',
            'japanese'=> 'くるみは、殻ごと食べるのが美味しい。',
            'photo'=> 'austin-pacheco-FtL07GM9Q7Y-unsplash.jpg'
        ]);
        
        DB::table('materials')->insert([
            'group_id' => 2,
            'main_word' => "I'm",
            'english'=> "I'm Kabirunrun",
            'japanese'=> '私は、かびルンルンです。',
            'photo'=> 'steven-libralon-Do1GQljlNk8-unsplash.jpg'
        ]);
        
        DB::table('materials')->insert([
            'group_id' => 2,
            'main_word' => 'dad',
            'english'=> 'My dad is Baikinman',
            'japanese'=> '僕のお父さんはバイキンマンです。',
            'photo'=> 'vishwanath-surpur-MaXtz1BRD08-unsplash.jpg'
        ]);
        
        DB::table('materials')->insert([
            'group_id' => 2,
            'main_word' => 'mam',
            'english'=> 'My mam is Dokinchan',
            'japanese'=> '僕のお母さんはドキンちゃんです。',
            'photo'=> 'matheus-ferrero-VWkWP3CMgm8-unsplash.jpg'
        ]);
    }
}
