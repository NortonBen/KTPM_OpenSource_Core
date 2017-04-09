<?php

use Illuminate\Database\Seeder;

class SexsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('Sexs')->insert([
            'name' => 'Nam'
            ]);
        DB::table('Sexs')->insert([
            'name' => 'Nữ'
        ]);
        DB::table('Sexs')->insert([
            'name' => 'Giới thứ Ba'
        ]);
        DB::table('Sexs')->insert([
            'name' => 'Giới thứ Tư'
        ]);
    }
}
