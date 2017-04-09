<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('relationshipsTable')->insert([
            'name' => 'Ế'
        ]);
        DB::table('relationshipsTable')->insert([
            'name' => 'Ế bền vững'
        ]);
        DB::table('relationshipsTable')->insert([
            'name' => 'Có Gấu'
        ]);
        DB::table('relationshipsTable')->insert([
            'name' => 'Vừa Bị Gấu Đá'
        ]);
        DB::table('relationshipsTable')->insert([
            'name' => 'Vừa Đá Gấu'
        ]);
        DB::table('relationshipsTable')->insert([
            'name' => 'FA Sống Ảo'
        ]);
        DB::table('relationshipsTable')->insert([
            'name' => 'Đa Giới (Giớ Thứ Tư)'
        ]);
        DB::table('relationshipsTable')->insert([
            'name' => 'Đa Quan Hệ'
        ]);
    }
}
