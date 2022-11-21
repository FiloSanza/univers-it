<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use App\Helpers\ControllerHelper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create', 'store']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('groups.create-group');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        
        $group = new Group();
        $group->creator_id = $user_id;

        if ($missing_field = ControllerHelper::checkRequiredFields($request, Group::REQUIRED_FIELDS)) {
            return Response("Missing field $missing_field", 401);
        }

        foreach (Group::REQUIRED_FIELDS as $field) {
            $group->$field = $request->$field;
        }

        $group->save();

        return redirect()->route('group.show', ['id' => $group->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($group = Group::where('id', $id)->first()) {
            return view('groups.group', ['group' => $group]);
        }
        
        return Response("Not found", 404);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
