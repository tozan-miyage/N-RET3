<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'group_name' => '5年生レベル'
        ]);
        
        DB::table('groups')->insert([
            'group_name' => '6年生レベル'
        ]);
        
        DB::table('groups')->insert([
            'group_name' => '中学生レベル'
        ]);
    }
}
