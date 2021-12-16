<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Web\User\UserStartupController;
use App\Http\Controllers\Web\User\UserHomeController;
use App\Http\Controllers\Web\User\UserDealController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){

Auth::routes();
Route::get('logout',[LoginController::class,'logout'])->name('logout');




Route::get('/home', [UserHomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:web','BlockedStartup'],'prefix' => 'startup'],function (){

Route::get('edit-account-info', [UserStartupController::class, 'editAccountInfo'])->name('user.edit.account');
Route::post('update-account-info',[UserStartupController::class,'updateAccount'])->name('user.update.account');


Route::get('show-startup-info', [UserStartupController::class, 'showStartupInfo'])->name('user.show.startup');
Route::get('deals-startup/{startup}',[UserDealController::class,'getDealStartup']);
Route::get('edit-startup-info',[UserStartupController::class,'edit'])->name('user.edit.startup');
Route::post('update-startup',[UserStartupController::class,'updateStartup'])->name('user.update.startup');


Route::post('deal-delete',[UserDealController::class,'destroyDeal'])->name('user.delete.deal');
Route::get('edit-deal/{deal}',[UserDealController::class,'editDeal'])->name('user.edit.deal');
Route::post('update-deal',[UserDealController::class,'updateDeal'])->name('user.update.deal');
Route::get('create-deal',[UserDealController::class,'createDeal'])->name('user.create.deal');
Route::post('store-deal',[UserDealController::class,'storeDeal'])->name('user.store.deal');



});


Route::get('/',[HomeController::class,'index'])->name('web.site.home');
Route::get('/deals',[HomeController::class,'getDeals'])->name('web.site.deals');

Route::get('show-deal/{deal}',[HomeController::class,'showDealInfo'])->name('web.site.show.deal');
Route::get('search-deals',[HomeController::class,'searchDeals'])->name('web.site.search.deals');





});




