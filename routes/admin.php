<?php

use App\Http\Controllers\Web\Admin\AdminTranslationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Web\Admin\AdminStartupController;
use App\Http\Controllers\Web\Admin\AdminSectorController;
use App\Http\Controllers\Web\Admin\AdminCityController;
use App\Http\Controllers\Web\Admin\AdminUserController;
use App\Http\Controllers\Web\Admin\AdminDealController;
use App\Http\Controllers\Web\Admin\AdminHomeController;
use App\Http\Controllers\AdminAuth\LoginController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){


Route::group(['prefix' => 'administration-dashboard','middleware' => ['auth:admin']],function (){

Route::get('home',[AdminHomeController::class,'index'])->name('admin.home');
Route::resource('users',AdminUserController::class)->except('update','destroy');
Route::post('update-user-password',[AdminUserController::class,'updateUserPassword'])->name('admin.update.password');
Route::post('delete-user',[AdminUserController::class,'deleteUser'])->name('admin.delete.user');
Route::get('users/edit-user-info/{user}',[AdminUserController::class,'editUserInfo'])->name('admin.edit.user.info');
Route::post('users/update-user-info',[AdminUserController::class,'updateUserInfo'])->name('admin.update.user.info');


Route::resource('sectors',AdminSectorController::class)->except(['update','destroy']);
Route::post('sectors-update',[AdminSectorController::class,'update'])->name('sector.update');
Route::get('sector-destroy/{sector}',[AdminSectorController::class,'destroy'])->name('sector.destroy');

Route::resource('cities',AdminCityController::class)->except(['update','destroy']);
Route::post('cities-update',[AdminCityController::class,'update'])->name('city.update');
Route::get('city-destroy/{city}',[AdminCityController::class,'destroy'])->name('city.destroy');


Route::get('translations',[AdminTranslationController::class,'index'])->name('admin.index.translations');
Route::get('translations/{fileLang}/edit',[AdminTranslationController::class,'edit'])->name('admin.edit.translations');
Route::post('translations/{fileLang}/update',[AdminTranslationController::class,'update'])->name('admin.update.translations');

Route::resource('startups',AdminStartupController::class)->except(['update','destroy']);
Route::post('create-user-startup',[AdminStartupController::class,'createUserStartup'])->name('admin.store.user.startup');
Route::post('startup-change-status',[AdminStartupController::class,'changeStartupStatus'])->name('admin.change.startup.status');
Route::post('startup-change-deal-status',[AdminStartupController::class,'changeStartupDealStatus'])->name('admin.change.startup.deal.status');


Route::get('deals-startup/{startup}',[AdminDealController::class,'startupDeals']);
Route::post('deal-change-status',[AdminDealController::class,'changeDealStatus'])->name('admin.change.deal.status');
Route::post('deal-delete',[AdminDealController::class,'destroyDeal'])->name('admin.delete.deal');


});

Route::group(['prefix' => 'administration-dashboard'],function (){

Route::get('login',[LoginController::class,'showLoginForm'])->name('admin.login');
Route::post('login',[LoginController::class,'login'])->name('admin.submit.login');
Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

});


});
