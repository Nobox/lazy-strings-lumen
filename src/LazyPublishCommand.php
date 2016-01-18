<?php

namespace Nobox\LazyStrings;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class LazyPublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lazy:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish configuration and assets for LazyStrings.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->publishConfiguration();
        $this->publishView();
        $this->publishLanguage();
        $this->publishCss();
    }

    /**
     * Export configuration file.
     *
     * @return void
     */
    private function publishConfiguration()
    {
        if (!file_exists(base_path().'/config')) {
            mkdir(base_path().'/config');
        }

        copy(__DIR__.'/../config/lazy-strings.php', base_path().'/config/lazy-strings.php');
        $this->info('Published config file to '.base_path().'/config/lazy-strings.php');
    }

    /**
     * Export deployment view template.
     *
     * @return void
     */
    private function publishView()
    {
        if (!file_exists(base_path().'/resources/views/lazy-strings')) {
            mkdir(base_path().'/resources/views/lazy-strings');
        }

        copy(__DIR__.'/../views/lazy.blade.php', base_path().'/resources/views/lazy-strings/lazy.blade.php');
        $this->info('Published view to '.base_path().'/resources/views/lazy-strings/lazy.blade.php');
    }

    /**
     * Publish the language directory if it doesn't exists.
     *
     * @return void
     */
    private function publishLanguage()
    {
        if (!file_exists(base_path().'/resources/lang/')) {
            mkdir(base_path().'/resources/lang');
            $this->info('Published language directory in '.base_path().'/resources/lang/');
        }
    }

    /**
     * Export deployment view css file.
     *
     * @return void
     */
    private function publishCss()
    {
        if (!file_exists(base_path().'/public/lazy-strings')) {
            mkdir(base_path().'/public/lazy-strings');
        }

        copy(__DIR__.'/../public/cover.css', base_path().'/public/lazy-strings/cover.css');
        $this->info('Published css to '.base_path().'/public/lazy-strings/cover.css');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
