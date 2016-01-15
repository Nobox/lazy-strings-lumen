<?php

/*
|--------------------------------------------------------------------------
| LazyStrings Routes
|--------------------------------------------------------------------------
|
| Route used to generate strings, will display a message if
| the strings are generated succesfully.
|
*/
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

$this->app->group(['namespace' => 'Nobox\LazyStrings\Http\Controllers', 'prefix' => 'lazy'], function () {
    $routeName = Config::get('lazy-strings.strings-route');

    $this->app->get($routeName, [
        'as' => 'lazy.deploy',
        'uses' => 'LazyStringsController@deploy'
    ]);
});
