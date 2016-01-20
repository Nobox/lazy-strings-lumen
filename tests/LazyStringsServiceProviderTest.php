<?php

namespace Nobox\LazyStrings\Tests;

use Laravel\Lumen\Testing\TestCase;

class LazyStringsServiceProviderTest extends TestCase
{
    public function createApplication()
    {
        return require __DIR__.'/app.php';
    }

    /**
     * @test
     */
    public function it_visits_the_homepage()
    {
        $this->visit('/')->see('Lumen');
    }
}
