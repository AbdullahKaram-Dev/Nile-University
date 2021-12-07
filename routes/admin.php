<?php

use App\Http\Controllers\Web\Admin\AdminTranslationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Web\Admin\AdminStartupController;
use App\Http\Controllers\Web\Admin\AdminSectorController;
use App\Http\Controllers\Web\Admin\AdminCityController;
use App\Http\Controllers\Web\Admin\AdminUserController;
use App\Http\Controllers\Web\Admin\AdminHomeController;
use App\Http\Controllers\AdminAuth\LoginController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){


Route::group(['prefix' => 'administration-dashboard','middleware' => ['auth:admin']],function (){

Route::get('home',[AdminHomeController::class,'index'])->name('admin.home');
Route::resource('users',AdminUserController::class)->except('update','destroy');
Route::post('update-user-password',[AdminUserController::class,'updateUserPassword'])->name('admin.update.password');


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

});

Route::group(['prefix' => 'administration-dashboard'],function (){

Route::get('login',[LoginController::class,'showLoginForm'])->name('admin.login');
Route::post('login',[LoginController::class,'login'])->name('admin.submit.login');
Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

});


});
