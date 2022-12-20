<?php

namespace App\Http\Controllers;

use App\Events\NewFollowerEvent;
use App\Models\FollowEdge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FollowEdgeController extends Controller
{
    /**
     * Save a new follow edge on db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(FollowEdge::VALIDATION_RULES);
        $followed_id = (int)$request->followed_id;

        if ($followed_id == Auth::id()) {
            return Redirect::back()->withErrors(['error' => 'You cannot follow yourself.']);
        }

        $existing_edge = FollowEdge::where(['follower_id' => Auth::id(), 'followed_id' => $followed_id])->first();
        if ($existing_edge) {
            return Redirect::back()->withErrors(['error' => 'You already follow this user.']);
        }

        $edge = new FollowEdge();
        $edge->follower_id = Auth::id();
        $edge->followed_id = $followed_id;
        $edge->save();

        event(new NewFollowerEvent($edge));

        return Redirect::back()->with('Success.');
    }

    /**
     * Delete a follow edge.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $request->validate(FollowEdge::VALIDATION_RULES);
        $followed_id = (int)$request->followed_id;

        $existing_edge = FollowEdge::where(['follower_id' => Auth::id(), 'followed_id' => $followed_id])->first();
        if ($existing_edge) {
            $existing_edge->delete();
            return Redirect::back()->with('Success.');
        }

        return Redirect::back()->withErrors(['error' => 'You did not follow this user.']);
    }
}
