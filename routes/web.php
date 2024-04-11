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
Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', 'App\Http\Controllers\PagesController@home')->name('home');

Route::get('/gallery', 'App\Http\Controllers\CreatureController@index')->name('gallery');

Route::post('/gallery', 'App\Http\Controllers\CreatureController@search')->name('search');

Route::get('/gallery/gallery_creature/{id}', 'App\Http\Controllers\CreatureController@creature_view')->name('gallery_creature');

Route::post('/gallery/gallery_creature/{id}/submit', 'App\Http\Controllers\ReviewController@submit')->name('gallery_creature.submit');

Route::get('/profile', 'App\Http\Controllers\PagesController@profile')->name('profile');

Route::middleware('guest')->group(function () {
    Route::get('/reg', 'App\Http\Controllers\PagesController@reg')->name('reg');
    Route::post('/reg/submit', 'App\Http\Controllers\RegisterController@index')->name('reg.submit');

    Route::get('/login', 'App\Http\Controllers\PagesController@login')->name('login');
    Route::post('/login/submit', 'App\Http\Controllers\LoginController@index')->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('login.logout');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');
    Route::post('/admin/submit', 'App\Http\Controllers\CreatureController@submit')->name('creature.submit');

    Route::post('/admin/photo/submit', 'App\Http\Controllers\CreatureController@photo_submit')->name('creature_photo.submit');
});




// В разработке
//Route::get('login/password_recovery', 'App\Http\Controllers\PagesController@password_recovery')->name('password_recovery');
//Route::post('login/password_recovery/submit', );
