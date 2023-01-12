<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use App\Models\User;
use Database\Seeders\TestUsersSeeder;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Tests\TestCaseWithSeeder;

class GroupControllerTest extends TestCaseWithSeeder
{
    /**
     * Test that authorized users can access to the group creation form.
     *
     * @return void
     */
    public function test_create_authorized()
    {
        $user = User::where('name', 'Filippo Sanzani')->first();
        Sanctum::actingAs($user);

        $this->assertNoErrorsInGetRequest(route('group.create'));
    }

    /**
     * Test that unauthorized users cannot access to the group creation form.
     *
     * @return void
     */
    public function test_create_unauthorized_should_not_access()
    {
        $res = $this->get(route('group.create'));
        $res->assertSessionDoesntHaveErrors()
            ->assertRedirect('/login');
    }

    /**
     * Test valid group show request.
     * 
     * @return void
     */
    public function test_show_valid()
    {
        $group = Group::factory()->create();
        $this->assertNoErrorsInGetRequest(route('group.show', $group->name));
    }

    public function data_for_test_group_show_invalid_name()
    {
        return [
            'name does not exist' => [ 'asd' ],    //no group in db anyway
            'name is not a string' => [ 1 ],
            'name is too long' => [ Str::random(1000) ],
        ];
    }

    /**
     * Test invalid group show requests.
     * 
     * @return void
     * @dataProvider data_for_test_group_show_invalid_name
     */
    public function test_group_show_invalid_name(mixed $name)
    {
        $this->assertErrorsInGetRequest(route('group.show', $name));
    }

    /**
     * Test unauthorized group creation.
     * 
     * @return void
     */
    public function test_create_group_unauthorized()
    {
        $name = Str::random(10);
        $description = Str::random(100);        // Do not use fake()->paragraph(), we validate the description length and random values might cause tests to fail.

        $this->assertNoErrorsInPostRequest(
            route('group.store'),                               // route
            [ 'name' => $name, 'description' => $description ], // params
            '/login'                                            // redirect
        );
    }

    /**
     * Test valid group creation.
     * 
     * @return void
     */
    public function test_create_group()
    {
        $user = User::where('name', 'Filippo Sanzani')->first();
        Sanctum::actingAs($user);

        $name = Str::random(10);
        $description = Str::random(100);        // Do not use fake()->paragraph(), we validate the description length and random values might cause tests to fail.

        $this->assertNoErrorsInPostRequest(
            route('group.store'),                               // route
            [ 'name' => $name, 'description' => $description ], // params
            route('group.show', $name)
        );

        $group = $this->getGroup($name);

        $this->assertNotNull($group);
        $this->assertEquals($group->name, $name);
        $this->assertEquals($group->creator_id, $user->id);
        $this->assertEquals($group->description, $description);
    }

    public function data_for_test_create_group_validation()
    {
        $valid_name = Str::random(10);
        $valid_description = Str::random(100);
        return [
            'wrong type for name' => [ 123, $valid_description ],
            'name too long' => [ Str::random(1000), $valid_description ],
            'wrong type for description' => [ $valid_name, 123 ],
            'description too long' => [ $valid_name, Str::random(1000) ],
        ];
    }

    /**
     * Test input validation for group store endpoint.
     * 
     * @return void
     * @dataProvider data_for_test_create_group_validation
     */
    public function test_create_group_validation(string|int $name, string|int $description)
    { 
        $user = User::where('name', 'Filippo Sanzani')->first();
        Sanctum::actingAs($user);

        $this->assertErrorsInPostRequest(
            route('group.store'),                               // route
            [ 'name' => $name, 'description' => $description ], // params
            []                                                  // errors
        );
    }

    private function getGroup(string $name)
    {
        return Group::where('name', $name)->first();
    }
}
