<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::create([
             'name' => 'محجوب محمد الطاهر',
             'email' => 'mahjoub@gmail.com',
             'password' => bcrypt('123123123'),
         ]);
    }
}
