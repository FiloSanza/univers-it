<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Group::VALIDATION_RULES);

        $group = new Group();
        $group->creator_id = Auth::id();

        foreach (Group::VALIDATION_RULES as $field => $_) {
            $group->$field = $request->$field;
        }

        $group->save();

        return redirect()->route('group.show', ['name' => $group->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(string $name)
    {
        Validator::validate(['name' => $name], [
            'name' => 'required|string|max:255'
        ]);

        

        if ($group = Group::where('name', $name)->first()) {
            return view('groups.group', ['group' => $group]);
        }
        
        return Response("Not found", 404);
    }

}
