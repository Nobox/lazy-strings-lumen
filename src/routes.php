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

$routeName = Config::get('lazy-strings.strings-route');

$this->app->get($routeName, function () {
    $lazyStrings = App::make('lazy-strings');
    $lazyStrings->generate();

    $metadata = $lazyStrings->getMetadata();

    $viewData['lazyVersion'] = $lazyStrings::VERSION;
    $viewData['refreshedBy'] = $metadata['refreshedBy'];
    $viewData['refreshedOn'] = $metadata['refreshedOn'];

    return view('lazy-strings.lazy', $viewData);
});
