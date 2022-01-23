<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/{from}', function ($from) {

    $container = new \App\Containers\AppContainer();
    $instance = $container->get(\App\Modules\Car::class, $from);
    dd($instance);
});
