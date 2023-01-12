<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $username)
    {
        Validator::validate(['name' => $username], [
            'name' => 'required|string|max:255|exists:users'
        ]);

        $user = User::where('name', $username)->first();
        return view('user.page', ['user' => $user]);
    }

    /**
     * Return infos about a user's followers.
     * 
     * @param string $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowersInfo(string $username) {
        Validator::validate(['name' => $username], [
            'name' => 'required|string|max:255|exists:users'
        ]);

        $user = User::where('name', $username)->first();
        return UserPageController::parseFollowLists($user->followers()->get());
    }

    /**
     * Return infos about the users followed by a given user.
     * 
     * @param string $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowingInfo(string $username) {
        Validator::validate(['name' => $username], [
            'name' => 'required|string|max:255|exists:users'
        ]);

        $user = User::where('name', $username)->first();
        return UserPageController::parseFollowLists($user->follows()->get());
    }

    private static function parseFollowLists(Collection $raw_users) {
        $users = $raw_users->map(function ($u) {
            return ['user' => $u, 'already_followed' => Helper::isAFollowerOfB(Auth::user(), $u)];
        });

        return response()->json([
            'view' => view('components.list.list', [
                'itemtemplate' => 'components.users.small',
                'items' => $users
            ])->render(),
            'count' => $users->count()
        ]);
    }
}
