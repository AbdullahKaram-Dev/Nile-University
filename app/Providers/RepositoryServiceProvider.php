<?php

namespace App\Providers;

use App\Http\Interfaces\Web\Admin\AdminDealInterface;
use App\Http\Interfaces\Web\User\UserDealStartupInterface;
use App\Http\Interfaces\Web\User\UserStartupInterface;
use App\Http\Repositories\Web\Admin\AdminDealRepository;
use App\Http\Repositories\Web\Admin\AdminStartupRepository;
use App\Http\Repositories\Web\Admin\AdminSectorRepository;
use App\Http\Repositories\Web\Admin\AdminHomeRepository;
use App\Http\Repositories\Web\Admin\AdminUserRepository;
use App\Http\Repositories\Web\Admin\AdminCityRepository;
use App\Http\Interfaces\Web\Admin\AdminStartupInterface;
use App\Http\Interfaces\Web\Admin\AdminSectorInterface;
use App\Http\Interfaces\Web\Admin\AdminUserInterface;
use App\Http\Interfaces\Web\Admin\AdminCityInterface;
use App\Http\Interfaces\Web\Admin\AdminHomeInterface;
use App\Http\Repositories\Web\User\UserDealStartupRepository;
use App\Http\Repositories\Web\User\UserStartupRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(AdminHomeInterface::class,AdminHomeRepository::class);
        $this->app->bind(AdminUserInterface::class,AdminUserRepository::class);
        $this->app->bind(AdminSectorInterface::class,AdminSectorRepository::class);
        $this->app->bind(AdminCityInterface::class,AdminCityRepository::class);
        $this->app->bind(AdminStartupInterface::class,AdminStartupRepository::class);
        $this->app->bind(AdminDealInterface::class,AdminDealRepository::class);
        $this->app->bind(UserStartupInterface::class,UserStartupRepository::class);
        $this->app->bind(UserDealStartupInterface::class,UserDealStartupRepository::class);
    }


    public function boot()
    {

    }
}
