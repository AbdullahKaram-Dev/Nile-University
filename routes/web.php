<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Web\User\UserHomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\User\UserStartupController;
use App\Http\Controllers\Web\User\UserDealController;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){

Auth::routes();
Route::get('logout',[LoginController::class,'logout'])->name('logout');




Route::group(['middleware' => ['auth:web','BlockedStartup'],'prefix' => 'startup'],function (){

Route::get('/home', [UserHomeController::class, 'index'])->name('home');
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

























//Route::get('en/email/verify/{id}/{hash}',[VerificationController::class,'verify'])->name('verification.verify');

    Route::get('/',function (){
        return view('web-site-home');
    })->name('web.site.home');



});




