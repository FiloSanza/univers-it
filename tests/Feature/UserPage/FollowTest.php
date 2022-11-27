<?php

namespace Tests\Feature\UserPage;

use App\Models\FollowEdge;
use App\Models\User;
use Database\Seeders\TestUsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCaseWithSeeder;

class FollowTest extends TestCaseWithSeeder
{
    use RefreshDatabase;

    /**
     * Prevent users from following themselves.
     *
     * @return void
     */
    public function test_users_cannot_follow_themeselves()
    {
        $user = User::where('name', 'Filippo Sanzani')->first();
        Sanctum::actingAs($user);

        $this->assertErrorsInPostRequest(
            route('follow'),
            [ 'followed_id' => $user->id ],
            [ 'error' => 'You cannot follow yourself.' ]
        );

        $this->assertNull($this->getEdge($user->id, $user->id));
    }

    /**
     * Prevent users from following the same user multiple times.
     *
     * @return void
     */
    public function test_cannot_follow_multiple_times()
    {
        $user_a = User::where('name', 'Filippo Sanzani')->first();
        $user_b = User::where('name', 'Lorenzo Drudi')->first();
        Sanctum::actingAs($user_a);

        $this->assertNoErrorsInPostRequest(
            route('follow'),
            [ 'followed_id' => $user_b->id ]
        );

        $this->assertNotNull($this->getEdge($user_a->id, $user_b->id));

        $this->assertErrorsInPostRequest(
            route('follow'),
            [ 'followed_id' => $user_b->id ],
            [ 'error' => 'You already follow this user.' ]
        );

        $this->assertNotNull($this->getEdge($user_a->id, $user_b->id));
    }

    /**
     * Test correct user follow request.
     * 
     * @return void
     */
    public function test_follow()
    {
        $user_a = User::where('name', 'Filippo Sanzani')->first();
        $user_b = User::where('name', 'Lorenzo Drudi')->first();
        Sanctum::actingAs($user_a);

        $this->assertNoErrorsInPostRequest(
            route('follow'),
            [ 'followed_id' => $user_b->id ]
        );

        $this->assertNotNull($this->getEdge($user_a->id, $user_b->id));
    }

    /**
     * A user cannot unfollow a user if he is not following them.
     * 
     * @return void
     */
    public function test_cannot_unfollow_if_not_following()
    {
        $user_a = User::where('name', 'Filippo Sanzani')->first();
        $user_b = User::where('name', 'Lorenzo Drudi')->first();
        Sanctum::actingAs($user_a);

        $this->assertErrorsInPostRequest(
            route('unfollow'), 
            ['followed_id' => $user_b->id], 
            [ 'error' => 'You did not follow this user.' ]
        );
    }

    /**
     * Test correct unfollow request.
     * 
     * @return void
     */
    public function test_unfollow()
    {
        $user_a = User::where('name', 'Filippo Sanzani')->first();
        $user_b = User::where('name', 'Lorenzo Drudi')->first();
        Sanctum::actingAs($user_a);

        $this->assertNoErrorsInPostRequest(
            route('follow'),
            [ 'followed_id' => $user_b->id ]
        );

        $this->assertNotNull($this->getEdge($user_a->id, $user_b->id));

        $this->assertNoErrorsInPostRequest(
            route('unfollow'),
            [ 'followed_id' => $user_b->id ]
        );

        $this->assertNull($this->getEdge($user_a->id, $user_b->id));
    }

    public function data_for_test_follow_request_validation_errors()
    {
        return [
            'id is a string' => [ 'asd' ],
            'id is missing' => [ null ],
            'id does not exist' => [ '-1' ],
        ];
    }

    /**
     * Test request validation for follow requests.
     *
     * @return void
     * @dataProvider data_for_test_follow_request_validation_errors
     */
    public function test_follow_request_validation_errors(?string $user_id) 
    {
        $user = User::where('name', 'Filippo Sanzani')->first();
        Sanctum::actingAs($user);

        $params = $user_id ? [ 'followed_id' => $user_id ] : [];
        $this->assertErrorsInPostRequest(
            route('follow'),
            $params
        );
    }

    private function getEdge(string $follower_id, string $followed_id)
    {
        return FollowEdge::where([ 'follower_id' => $follower_id, 'followed_id' => $followed_id ])->first();
    }
}
