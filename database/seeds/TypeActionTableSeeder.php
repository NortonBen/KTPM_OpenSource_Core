<?php

use Illuminate\Database\Seeder;

class TypeActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('typeactions')->insert([
            'name' => 'Thích'
        ]);
        DB::table('typeactions')->insert([
            'name' => 'Ghét'
        ]);
        DB::table('typeactions')->insert([
            'name' => 'Yêu'
        ]);
        DB::table('typeactions')->insert([
            'name' => 'Bối dỗi'
        ]);
        DB::table('typeactions')->insert([
            'name' => 'Tức Giận'
        ]);
        DB::table('typeactions')->insert([
            'name' => 'Điên'
        ]);
        DB::table('typeactions')->insert([
            'name' => 'Òa Khóc'
        ]);
        DB::table('typeactions')->insert([
            'name' => 'Ngu Người'
        ]);
    }
}
