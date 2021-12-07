<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){

Auth::routes(['verify' => true]);
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::get('en/email/verify/{id}/{hash}',[VerificationController::class,'verify'])->name('verification.verify');

Route::get('/',function (){
    return view('web-site-home');
})->name('web.site.home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});




