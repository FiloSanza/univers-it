<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        // TODO: Check if validator fails if user is not found, right now the redirection fails.
        $user = User::where('name', $username)->first();
        return view('user.page', ['user' => $user]);
    }
}
