<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get("/mothers/q", "MotherController@findMotherByName");
$router->get("/mothers/{id}", "MotherController@findMotherById");
$router->get("/mothers", "MotherController@getAll");
$router->post("/mothers", "MotherController@create");

