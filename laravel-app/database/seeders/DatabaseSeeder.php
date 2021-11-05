<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Worker;
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
        // User::factory(100)->create();
        //Company::factory(1000)->create();
        // \App\Models\User::factory(10)->create();
        Worker::factory(500)->create();
    }
}
