<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\City;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Admin::factory(1)->create();
        Sector::factory(10)->create();
        City::factory(10)->create();
    }
}
