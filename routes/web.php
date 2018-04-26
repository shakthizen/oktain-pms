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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->post('login', 'UserController@login');
        $router->post('register', 'UserController@register');

        $router->group(['middleware' => 'auth'], function () use ($router){
            $router->get('members', 'UserController@getAll');
            $router->get('login/check', 'UserController@checkToken');

            $router->get('dashboard', 'DashboardController@getDash');

            $router->get('project', 'ProjectController@index');
            $router->get('project/{id}', 'ProjectController@read');
            $router->delete('project/{id}', 'ProjectController@delete');
            $router->post('project', 'ProjectController@create');
            $router->put('project/{id}', 'ProjectController@update');
            $router->post('project/{project}/{member}', 'ProjectController@addMember');
            $router->delete('project/{project}/{member}', 'ProjectController@deleteMember');

            $router->get('service', 'ServiceController@index');
            $router->get('service/{id}', 'ServiceController@read');
            $router->delete('service/{id}', 'ServiceController@delete');
            $router->post('service/{project}', 'ServiceController@create');
            $router->put('service/{id}', 'ServiceController@update');

            $router->get('task', 'TaskController@index');
            $router->get('task/{id}', 'TaskController@read');
            $router->delete('task/{id}', 'TaskController@delete');
            $router->post('task/{service}', 'TaskController@create');
            $router->put('task/{id}', 'TaskController@update');

            $router->get('product', 'ProductController@index');
            $router->get('product/{id}', 'ProductController@read');
            $router->delete('product/{id}', 'ProductController@delete');
            $router->post('product/{project}', 'ProductController@create');
            $router->put('product/{id}', 'ProductController@update');
        });
    });
});

$router->get('/', function () use ($router) {
    return view('index');
});