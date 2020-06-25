<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Home\\IndexController')->name('home');
Route::post('/register-interest', 'Store\\Interest\\RegisterController')->name('register.interest');

Route::get('/validate-slug/{slug}', function ($slug) {
    return json_encode(['exists' => \App\Merchant::whereUrlSlug($slug)->exists()]);
});

Route::get('/how-it-works', 'About\\HowItWorksController')->name('about.how-it-works');
Route::get('/thanks', 'Store\\Interest\\ThanksController')->name('register.thanks');
