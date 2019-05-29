<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * Routes
 */
$router->group(['prefix' => 'api/v1'], function() use(&$router) {
    /**
     * Auth
     */
    $router->group(['prefix' => 'auth'], function() use(&$router) {
        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');
    });

    /**
     * Authors
     */
    $router->group(['prefix' => 'authors'], function() use(&$router) {

        $router->group(['middleware' => 'auth:api'], function() use(&$router) {
            $router->post('/', 'AuthorsController@store');
            $router->put('/{id}', 'AuthorsController@update');
            $router->delete('/{id}', 'AuthorsController@destroy');
        });
        $router->get('/', 'AuthorsController@index');
        $router->get('{id}', 'AuthorsController@show');
    });

    $router->group(['prefix' => 'books'], function() use(&$router) {
        $router->group(['middleware' => 'auth:api'], function() use(&$router) {
            $router->post('/', 'BooksController@store');
            $router->put('/{isbn}', 'BooksController@update');
            $router->delete('/{isbn}', 'BooksController@destroy');
        });

        $router->get('/', 'BooksController@index');
        $router->get('/{isbn}', 'BooksController@show');
    });

});
