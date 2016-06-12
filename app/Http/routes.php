<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function(){



    // Create User
    Route::post('/users', 'UsersController@store');

    // Login
    Route::post('/login', 'UsersController@login');


    Route::group(['middleware' => 'auth:api'], function () {
        // Users
        Route::get('/users', 'UsersController@index');

        Route::get('/users/{user}', 'UsersController@show');
        Route::put('/users/{user}', 'UsersController@update');
        Route::delete('/users/{user}', 'UsersController@destroy');



        Route::post('/users/{user}/courses/{course}', 'UsersController@enroll');
        Route::delete('/users/{user}/courses/{course}', 'UsersController@dropout');

        // Courses
        Route::get('/courses', 'CoursesController@index');
        Route::get('/users/{user}/courses', 'CoursesController@indexByUser');
        Route::post('courses', 'CoursesController@store');
        Route::get('/courses/{course}', 'CoursesController@show');
        Route::put('/courses/{course}', 'CoursesController@update');
        Route::delete('/courses/{course}', 'CoursesController@destroy');
    });

});

