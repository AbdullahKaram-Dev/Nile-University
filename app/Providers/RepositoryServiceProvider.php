<?php

namespace App\Providers;

use App\Http\Interfaces\Web\Admin\AdminCityInterface;
use App\Http\Interfaces\Web\Admin\AdminHomeInterface;
use App\Http\Interfaces\Web\Admin\AdminSectorInterface;
use App\Http\Interfaces\Web\Admin\AdminUserInterface;
use App\Http\Repositories\Web\Admin\AdminHomeRepository;
use App\Http\Repositories\Web\Admin\AdminSectorRepository;
use App\Http\Repositories\Web\Admin\AdminUserRepository;
use App\Http\Repositories\Web\Admin\AdminCityRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(AdminHomeInterface::class,AdminHomeRepository::class);
        $this->app->bind(AdminUserInterface::class,AdminUserRepository::class);
        $this->app->bind(AdminSectorInterface::class,AdminSectorRepository::class);
        $this->app->bind(AdminCityInterface::class,AdminCityRepository::class);
    }


    public function boot()
    {

    }
}
