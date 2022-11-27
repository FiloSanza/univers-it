<?php

namespace Tests;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

abstract class TestCaseWithSeeder extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Default database seeder.
     * 
     * @var string
     */
    protected $seeder = DatabaseSeeder::class;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed($this->seeder);
    }

    protected function assertErrorsInPostRequest(string $route, array $params, array $errors, string $redirect = '/')
    {
        $res = $this->post($route, $params);
        $res->assertRedirect($redirect)
            ->assertSessionHasErrors($errors);
    }

    protected function assertNoErrorsInPostRequest(string $route, array $params, string $redirect = '/')
    {
        $res = $this->post($route, $params);
        $res->assertRedirect($redirect)
            ->assertSessionDoesntHaveErrors();
    }
}
