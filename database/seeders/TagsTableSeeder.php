<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tags = [
            ['name' => 'coding'],
            ['name' => 'help'],
            ['name' => 'bijles'],
        ];

        DB::table('tags')->insert($tags);
    }
}
