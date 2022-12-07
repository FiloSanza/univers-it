<?php

namespace App\Http\Controllers;

use App\Models\GroupFollowEdge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GroupFollowEdgeController extends Controller
{
    /**
     * Save a new group follow edge on db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(GroupFollowEdge::VALIDATION_RULES);
        $group_id = (int)$request->group_id;

        $existing_edge = GroupFollowEdge::where(['user_id' => Auth::id(), 'group_id' => $group_id])->first();
        if ($existing_edge) {
            return Redirect::back()->withErrors(['error' => 'You already follow this group.']);
        }

        $edge = new GroupFollowEdge();
        $edge->user_id = Auth::id();
        $edge->group_id = $group_id;
        $edge->save();

        return Redirect::back()->with('Success.');
    }

    /**
     * Delete a group follow edge.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $request->validate(GroupFollowEdge::VALIDATION_RULES);
        $group_id = (int)$request->group_id;

        $existing_edge = GroupFollowEdge::where(['user_id' => Auth::id(), 'group_id' => $group_id])->first();
        if ($existing_edge) {
            $existing_edge->delete();
            return Redirect::back()->with('Success.');
        }

        return Redirect::back()->withErrors(['error' => 'You did not follow this user.']);
    }
}
