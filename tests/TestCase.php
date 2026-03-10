<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Stub out Vite so tests don't fail when no manifest is built.
        $this->app->instance(
            \Illuminate\Foundation\Vite::class,
            new class {
                public function __invoke($entrypoints, $buildDirectory = null): \Illuminate\Support\HtmlString
                {
                    return new \Illuminate\Support\HtmlString('');
                }
            }
        );
    }
}
