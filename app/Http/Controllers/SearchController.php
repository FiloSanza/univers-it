<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;

class SearchController extends Controller
{

    /**
     * Display the users and the groups whose names contains the text input.
     *
     * @param string $name
     * @return \Illuminate\View\View
     */
    public function show($name=null)
    { 

        $results['users'] = User::query()
            ->where('name', 'LIKE', "%{$name}%")
            ->get();

        $results['groups'] = Group::query()
            ->where('name', 'LIKE', "%{$name}%")
            ->get();

        return view('search.search', ['substring' => $name, 'results' => $results]);
    }

}
