<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'admmin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'sex' => true,
            'phone' => "45978323",
            'phone_parent' => '475876',
            'birthday' => '2017-03-01',
            'description' => 'Khong co gi',
            'address' => 'thai nguyen',
            'company' =>'Thất Nghiệp',
            'relationships' => 1
        ]);

        DB::table('users')->insert([
            'first_name' => 'user',
            'last_name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'sex' => true,
            'phone' => "45978323",
            'phone_parent' => '475876',
            'birthday' => '2017-03-01',
            'description' => 'Khong co gi',
            'address' => 'thai nguyen',
            'company' =>'Thất Nghiệp',
            'relationships' => 1
        ]);
    }
}
