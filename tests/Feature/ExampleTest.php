<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        // Root redirects to admin dashboard (302)
        $response = $this->get('/');
        $response->assertRedirect();
    }
}
