<?php


    Route::get('/user','AuthController@user');
    Route::post('/register','AuthController@register');
    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout');

Route::group(['prefix'=>'topics'],function(){
    //topics
    Route::post('/','TopicController@store')->middleware('auth:api');
    Route::get('/','TopicController@index');
    Route::get('/{topic}','TopicController@show');
    Route::patch('/{topic}', 'TopicController@update')->middleware('auth:api');
    Route::delete('/{topic}', 'TopicController@destroy')->middleware('auth:api');

    //post
    Route::group(['prefix'=>'/{topic}/posts'],function(){
        Route::post('/','PostController@store')->middleware('auth:api');
        Route::get('/{post}','PostController@show');
        Route::patch('/{post}', 'PostController@update')->middleware('auth:api');
        Route::delete('/{post}', 'PostController@destroy')->middleware('auth:api');
    });

    //likes
    Route::group(['prefix' => '/{post}/likes'], function () {
        Route::post('/', 'PostLikeController@store')->middleware('auth:api');
    });

});

