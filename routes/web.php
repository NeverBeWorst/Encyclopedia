<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

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

Route::get('/image-generator', 'App\Http\Controllers\ImageGeneratorController@index')->name('image.generator');
Route::post('/generate-image', 'App\Http\Controllers\ImageGeneratorController@generate' )->name('generate.image');
Route::post('/save-image', 'App\Http\Controllers\ImageGeneratorController@save' )->name('save.image');

Route::redirect('/', '/home');

Route::get('/home', 'App\Http\Controllers\PagesController@home')->name('home');


Route::prefix('/gallery')->group(function () {
    Route::get('/', 'App\Http\Controllers\CreatureController@index')->name('gallery');

    Route::post('/', 'App\Http\Controllers\CreatureController@search')->name('search');

    Route::get('/creature/{id}', 'App\Http\Controllers\CreatureController@creature_view')->name('gallery.creature');

    Route::get('/custom_creature/{id}', 'App\Http\Controllers\CreatureController@custom_creature_view')->name('gallery.custom_creature');

    Route::post('/suggestions', 'App\Http\Controllers\CreatureController@suggestions')->name('search.suggestions');
});


Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('profile');

Route::get('/profile/user/{id}', 'App\Http\Controllers\UserController@user_profile')->name('profile.user');    


Route::middleware('guest')->group(function () {
    Route::get('/reg', 'App\Http\Controllers\PagesController@reg')->name('reg');
    Route::post('/reg/submit', 'App\Http\Controllers\RegisterController@index')->name('reg.submit');

    Route::get('/login', 'App\Http\Controllers\PagesController@login')->name('login');
    Route::post('/login/submit', 'App\Http\Controllers\LoginController@index')->name('login.submit');
});


Route::middleware('auth')->group(function () {
    Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('login.logout');

    Route::name('user.')->group(function () {
        Route::prefix('/profile')->group(function () {
            Route::get('/proposal_creature', 'App\Http\Controllers\PagesController@proposal_creature')->name('proposal_creature');
            Route::post('/proposal_creature/submit', 'App\Http\Controllers\UserController@proposal_creature')->name('proposal_creature.submit');


            Route::get('/custom_creature', 'App\Http\Controllers\PagesController@custom_creature')->name('custom_creature');
            Route::post('/custom_creature/submit', 'App\Http\Controllers\UserController@custom_creature')->name('custom_creature.submit');


            Route::post('/avatar', 'App\Http\Controllers\UserController@add_avatar')->name('avatar.submit');


            Route::post('/user/{id}/friend_request', 'App\Http\Controllers\UserController@friend_request')->name('friend_request.submit');

            Route::post('/friends/{id}/confirm', 'App\Http\Controllers\UserController@confirm_friend_request')->name('friend_request.confirm');
            Route::post('/friends/{id}/reject', 'App\Http\Controllers\UserController@reject_friend_request')->name('friend_request.reject'); 
        });
        
    });

    
    Route::post('gallery/gallery_creature/{id}/submit', 'App\Http\Controllers\ReviewController@submit')->name('gallery_creature.submit');

});


Route::middleware('auth', 'admin')->group(function () {
    Route::name('admin.')->group(function () { 
        Route::prefix('/admin')->group(function () {
            Route::get('/', 'App\Http\Controllers\AdminController@index')->name('main');
            
            Route::prefix('/creature')->group(function () {
                Route::post('/submit', 'App\Http\Controllers\CreatureController@submit')->name('creature.submit');
                Route::post('/creature_with_img/submit', 'App\Http\Controllers\CreatureController@submit_with_image')->name('creature_with_img.submit');
        
                Route::get('/proposal_add', 'App\Http\Controllers\AdminController@proposal_creature')->name('proposal_creature');

                Route::get('/proposal_add/{id}', 'App\Http\Controllers\AdminController@proposal_creature_view')->name('proposal_creature.view');
        
                Route::post('/proposal_add/{id}/confirm', 'App\Http\Controllers\AdminController@confirm_proposal')->name('proposal_creature.confirm');
                Route::post('/proposal_add/{id}/reject', 'App\Http\Controllers\AdminController@reject_proposal')->name('proposal_creature.reject');

                Route::get('/custom_creatures', 'App\Http\Controllers\AdminController@custom_creatures')->name('custom_creature');
            
                Route::post('/photo/submit', 'App\Http\Controllers\CreatureController@image_submit')->name('creatures_image.submit');
            });
            
    
            Route::prefix('/commands')->group(function () {

                Route::post('/refresh', function () {
                    $exitCode = Artisan::call('migrate:refresh');
                    return redirect()->back();
                })->name('refresh');

                Route::post('/do_admin', function (Request $req) {
                    $exitCode = Artisan::call('DoAdmin', ['name' => $req->name]);
                    return redirect()->back();
                })->name('do_admin');
            });
    
            Route::get('/users', 'App\Http\Controllers\AdminController@users')->name('users');
            Route::post('/users/{id}/block', 'App\Http\Controllers\AdminController@user_block')->name('user_block');
            Route::post('/users/{id}/delete', 'App\Http\Controllers\AdminController@user_delete')->name('user_delete');
            Route::post('/users/search', 'App\Http\Controllers\AdminController@users_search')->name('users.search');
        }); 
    });
    
    
});




// В разработке
//Route::get('login/password_recovery', 'App\Http\Controllers\PagesController@password_recovery')->name('password_recovery');
//Route::post('login/password_recovery/submit', );




/* Это секрет! Тссс */ 



Route::redirect('/secret', '/minigames/select')->middleware('auth')->name('secret');

Route::middleware('auth')->group(function () {
    Route::name('minigames.')->group(function () {
        Route::prefix('/minigames')->group(function () {
            Route::get('/select', 'App\Http\Controllers\Minigames\MinigamesController@select')->name('select');

            Route::get('/game/find_pair', 'App\Http\Controllers\Minigames\MinigamesController@find_pair')->name('find_pair');
        });
    });
});



