<?php

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

Route::get('/', [
    'uses' => 'BlogController@index',
    'as' => 'blog'
]);
Route::get('/blog/{post}', [
    'uses' => 'BlogController@show',
    'as' => 'blog.show'
]);
Route::post('/blog/{post}/comments', [
    'uses' => 'BlogController@comments',
    'as' => 'blog.comments'
]);

Route::get('/category/{category}', [
    'uses' => 'BlogController@category',
    'as' => 'category'
]);
Route::get('/author/{user}', [
    'uses' => 'BlogController@author',
    'as' => 'author'
]);
Route::get('/tag/{tag}', [
    'uses' => 'BlogController@tag',
    'as' => 'tag'
]);

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/edit-account', 'Backend\HomeController@edit')->name('edit.account');
Route::put('/edit-account/', 'Backend\HomeController@update')->name('update.account');

Route::namespace('Backend')->prefix('backend')->name('backend.')->group(function () {
    Route::resource('blog', 'BlogController');
    Route::post('blog/restore/{id}', [
        'uses' => 'BlogController@restore',
        'as' => 'blog.restore'
    ]);
    Route::delete('blog/force-destroy/{id}', [
        'uses' => 'BlogController@forceDestroy',
        'as' => 'blog.force-destroy'
    ]);
});
Route::namespace('Backend')->prefix('backend')->name('backend.')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('users', 'UserController', ['except' => 'destroy']);
    Route::delete('users/{user}', [
        'as' => 'users.destroy',
        'uses' => 'UserController@destroy'
    ]);
    Route::get('users/{user}', [
        'as' => 'users.confirm',
        'uses' => 'UserController@confirm'
    ]);
});

Route::get('/tags',function (){
    $tags = App\Tag::pluck('name');
    return $tags;
});
