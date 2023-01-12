<?php

namespace Tests;

use Database\Seeders\Test\TestSeeder;
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
    protected $seeder = TestSeeder::class;

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

    protected function assertErrorsInPostRequest(string $route, array $params, array $errors = [], string $redirect = '/')
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

    protected function assertErrorsInGetRequest(string $route, array $params = [], array $errors = [], string $redirect = '/')
    {
        $res = $this->get($route, $params);
        $res->assertSessionHasErrors($errors)
            ->assertRedirect($redirect);
    }

    protected function assertNoErrorsInGetRequest(string $route, array $params = [])
    {
        $res = $this->get($route, $params);
        $res->assertSessionDoesntHaveErrors();
    }
}
