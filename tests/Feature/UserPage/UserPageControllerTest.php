<?php

namespace Tests\Feature\UserPage;

use Database\Seeders\Test\TestUsersSeeder;
use Illuminate\Support\Str;
use Tests\TestCaseWithSeeder;

class UserPageControllerTest extends TestCaseWithSeeder
{
    /**
     * Test show user page for guest user.
     *
     * @return void
     */
    public function test_show_user_page_guest()
    {
        $this->assertNoErrorsInGetRequest(route('userpage.show', 'Filippo Sanzani'));
    }

    public function data_for_test_show_user_page_validation()
    {
        return [
            'wrong type' => [ 123 ],
            'name too long' => [ Str::random(1000) ],
            'name not found' => [ 'no one' ],
        ];
    }

    /**
     * Test data validation for show user page.
     * 
     * @return void
     * @dataProvider data_for_test_show_user_page_validation
     */
    public function test_show_user_page_validation(string|int $name)
    {
        $this->assertErrorsInGetRequest(route('userpage.show', $name));
    }
}
