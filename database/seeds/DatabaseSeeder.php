<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RelationshipsTableSeeder::class);
         $this->call(SexsTableSeeder::class);
         $this->call(TypeActionTableSeeder::class);
         $this->call(UsersTableSeeder::class);
    }
}
