<?php

namespace Nobox\LazyStrings\Tests;

use Laravel\Lumen\Testing\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class LazyStringsServiceProviderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        mkdir(__DIR__.'/../resources/lang/', 0777, true);
        mkdir(__DIR__.'/../resources/views/lazy-strings/', 0777, true);
        mkdir(__DIR__.'/../storage/app/', 0777, true);
        mkdir(__DIR__.'/../storage/framework/cache/', 0777, true);
        mkdir(__DIR__.'/../storage/framework/sessions/', 0777, true);
        mkdir(__DIR__.'/../storage/framework/views/', 0777, true);
        copy(__DIR__.'/../views/lazy.blade.php', __DIR__.'/../resources/views/lazy-strings/lazy.blade.php');
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->removeDirectory(__DIR__.'/../resources/');
        $this->removeDirectory(__DIR__.'/../storage/');
    }

    public function createApplication()
    {
        return require __DIR__.'/app.php';
    }

    /**
     * @test
     */
    public function it_shows_strings_generation_view()
    {
        $response = $this->call('GET', '/lazy/build-copy');
        $this->assertResponseOk();
    }

    /**
     * Remove a directory and it's contents.
     *
     * @param string $path
     *
     * @return void
     */
    private function removeDirectory($path)
    {
        if (!file_exists($path)) {
            return;
        }

        $iterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }

        rmdir($path);
    }
}
