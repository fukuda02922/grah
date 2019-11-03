<?php


Route::group(['middleware' => 'auth'], function () {
    Route::get('/mypage', 'PostsController@mypage');
    Route::get('/posts/create', 'PostsController@create');
    Route::get('/posts/{id}/edit', 'PostsController@edit');
    Route::post('/posts/', 'PostsController@store');
    Route::patch('/posts/{id}', 'PostsController@update');
    Route::delete('/posts/{id}', 'PostsController@destroy');

    Route::post('/posts/{post}/comments', 'CommentsController@store');
    Route::delete('/posts/{post}/comments/{comment}',
        'CommentsController@destroy');
});

Route::get('/', 'PostsController@index');
Route::post('/posts/search', 'PostsController@search');
Route::post('/posts/size', 'PostsController@size');
Route::get('/posts/{id}', 'PostsController@show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/pwreset', 'CustomerController@viewPwReset');

Route::post('/mails/pwreset', 'CustomerController@sendPwreset');
Route::get('/sample', 'SampleController@sample');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
