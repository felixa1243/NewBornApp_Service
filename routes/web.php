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

//mother router

$router->get("/mothers/q", "MotherController@findMotherByName");
$router->get("/mothers/{id}", "MotherController@findMotherById");
$router->get("/mothers", "MotherController@getAll");
$router->post("/mothers", "MotherController@create");
$router->put("/mothers/{id}", "MotherController@update");
$router->delete("/mothers/{id}", "MotherController@delete");

//infants router
$router->get("/infants/q", "InfantsController@getAllByDateRange");
$router->get("/infants/{id}", "InfantsController@getById");
$router->get("/infants", "InfantsController@getAll");
$router->post("/infants", "InfantsController@create");
$router->put("/infants/{id}", "InfantsController@update");
$router->delete("/infants/{id}", "InfantsController@delete");
$router->get("/infants/analytics", "InfantsController@getYearlyAnalytics");
