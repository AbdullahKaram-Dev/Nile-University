<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Startup;
use App\Models\Sector;
use App\Models\Admin;
use App\Models\City;
use App\Models\Deal;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Admin::factory(1)->create();
        Sector::factory(10)->create();
        City::factory(10)->create();
        Startup::factory(1)->create();
        Deal::factory(2)->create();
    }
}
