<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Image;
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
        $group->name = $request->name;
        $group->description = $request->description;
        $group->image_id = ImageController::persist($request->image);

        $group->save();

        return redirect()->route('group.show', ['name' => $group->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $name)
    {
        Validator::validate(['name' => $name], [
            'name' => 'required|string|max:255|exists:groups'
        ]);

        // TODO: Check if validator fails if group is not found, right now the redirection fails.
        $group = Group::where('name', $name)->first();
        return view('groups.group', ['group' => $group]);
    }

}
