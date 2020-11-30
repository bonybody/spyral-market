<?php
use App\Events\MessageAdded;

Route::get('/', 'welcomeController@welcome');

Route::get('/login', 'UserAuth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'UserAuth\LoginController@login');
Route::get('/logout', 'UserAuth\LoginController@logout')->name('logout');

Route::get('/register', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'UserAuth\RegisterController@register');

Route::post('/password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
Route::post('/password/reset', 'UserAuth\ResetPasswordController@reset')->name('password.email');
Route::get('/password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('/password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');

Route::group(['prefix' => 'admin'], function () {

  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

});

Route::group(['prefix' => 'home', 'middleware' => 'user'], function () {

    Route::get('/', 'HomeController@index');

    Route::group(['prefix' => 'item'], function () {
        Route::get('/buy_history', 'ItemController@buy_history');

        Route::get('/{id}', 'ItemController@item');
        Route::post('/buy', 'ItemController@buy');
    });

    Route::group(['prefix' => 'my_item'], function () {
        Route::get('/', 'MyItemController@index');
        Route::get('/delete', 'MyItemController@delete');
        Route::get('/push_delete', 'MyItemController@push_delete');
    });

    Route::group(['prefix' => 'put_up'], function () {
        Route::get('/', 'PutUpController@put_up_get');
        Route::post('/', 'PutUpController@put_up_post');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/{id}', 'HomeController@user');
        Route::get('/edit/{id}', 'HomeController@user_edit_get');
        Route::post('/edit', 'HomeController@user_edit_post');
        Route::post('/follow', 'FollowController@follow');
        Route::post('/unfollow', 'FollowController@unfollow');
    });

    Route::group(['prefix' => 'follow'], function () {
        Route::get('/', 'FollowController@my_follows');
        Route::get('/item', 'FollowController@my_follow_items');
    });

    Route::group(['prefix' => 'search'], function () {
        Route::get('/new', 'HomeController@new_item');
        Route::get('/keyword/', 'SearchController@keyword');
        Route::get('/tag/{id}', 'SearchController@tag');
        Route::get('/subject/{id}', 'SearchController@subject');
    });

    Route::group(['prefix' => 'chat'], function () {
        Route::get('/', 'ChatController@get_rooms');
        Route::get('/room/{id}/{position}', 'ChatController@room');
        Route::post('/room/complete_check', 'ChatController@complete_check');
    });
});
