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
define('ROUTE_BASE', 'lumen/public');
$app->get(ROUTE_BASE.'/', function () use ($app) {
 
});

$app->get(ROUTE_BASE.'/test', function () use ($app) {
   echo 222;
});
