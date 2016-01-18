<?php

namespace Nobox\LazyStrings;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Nobox\LazyStrings\LazyDeployCommand;
use Nobox\LazyStrings\LazyPublishCommand;
use Nobox\LazyStrings\LazyStrings;

class LazyStringsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
        include __DIR__.'/helpers.php';
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLazyStrings();
        $this->registerDeploymentCommand();
        $this->registerPublishCommand();
    }

    /**
     * Register lazy strings instance on the container.
     *
     * @return void
     */
    private function registerLazyStrings()
    {
        $this->app->bind('lazy-strings', function () {
            return new LazyStrings([
                'url'    => Config::get('lazy-strings.csv-url'),
                'sheets' => Config::get('lazy-strings.sheets'),
                'target' => base_path() . '/resources/lang',
                'backup' => base_path() . '/storage/' . Config::get('lazy-strings.target-folder'),
                'nested' => Config::get('lazy-strings.nested')
            ]);
        });
    }

    /**
     * Register deployment command on the container.
     *
     * @return void
     */
    private function registerDeploymentCommand()
    {
        $this->app->bind('command.lazy-deploy', function () {
            return new LazyDeployCommand();
        });

        $this->commands('command.lazy-deploy');
    }

    /**
     * register publish of assets on the container.
     *
     * @return void
     */
    private function registerPublishCommand()
    {
        $this->app->bind('command.lazy-publish', function () {
            return new LazyPublishCommand();
        });

        $this->commands('command.lazy-publish');
    }
}
