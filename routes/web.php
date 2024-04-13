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
    
    Route::post('/admin/creature/submit', 'App\Http\Controllers\CreatureController@submit')->name('creature.submit');
    Route::post('/admin/creature/creature_with_img/submit', 'App\Http\Controllers\CreatureController@submit_with_image')->name('creature_with_img.submit');

    Route::get('/admin/creature/proposal_add', 'App\Http\Controllers\PagesController@proposal_add_creature')->name('proposal_add_creature');

    Route::post('/admin/creature/proposal_add/{id}/confirm', 'App\Http\Controllers\CreatureController@confirm_proposal')->name('proposal_add_creature.confirm');
    Route::post('/admin/creature/proposal_add/{id}/reject', 'App\Http\Controllers\CreatureController@reject_proposal')->name('proposal_add_creature.reject');

    Route::post('/admin/photo/submit', 'App\Http\Controllers\CreatureController@image_submit')->name('creatures_image.submit');

    Route::post('/admin/user/{id}/block', 'App\Http\Controllers\AdminController@user_block')->name('user_block');
    Route::post('/admin/user/{id}/delete', 'App\Http\Controllers\AdminController@user_delete')->name('user_delete');
});




// В разработке
//Route::get('login/password_recovery', 'App\Http\Controllers\PagesController@password_recovery')->name('password_recovery');
//Route::post('login/password_recovery/submit', );
