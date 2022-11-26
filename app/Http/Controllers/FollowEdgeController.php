<?php

namespace App\Http\Controllers;

use App\Models\FollowEdge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowEdgeController extends Controller
{
    /**
     * Save a new follow edge on db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate(FollowEdge::VALIDATION_RULES);
        
        //TODO: test
        dd($request);

        $edge = new FollowEdge();
        $edge->follower_id = Auth::id();
        $edge->followed_id = $request['followed_id'];
        $edge->save();

        return Response('Success', 200);
    }
}
