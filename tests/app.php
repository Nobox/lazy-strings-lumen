<?php

require_once __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

$app->withFacades();
$app->configure('lazy-strings');
$app->register(Nobox\LazyStrings\LazyStringsServiceProvider::class);

$app->get('/', function() use($app) {
    return $app->welcome();
});

use Illuminate\Support\Facades\Config;

$app->group(['namespace' => 'Nobox\LazyStrings\Http\Controllers', 'prefix' => 'lazy'], function() use($app) {
    $routeName = Config::get('lazy-strings.strings-route');

    $app->get($routeName, [
        'as' => 'lazy.deploy',
        'uses' => 'LazyStringsController@deploy'
    ]);
});

return $app;
