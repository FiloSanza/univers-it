<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display the users and the groups whose names contains the text input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $name = $request->query("q");

        $results['users'] = User::query()
            ->where('name', 'LIKE', "%{$name}%")
            ->get();

        $results['groups'] = Group::query()
            ->where('name', 'LIKE', "%{$name}%")
            ->get();

        return view('search.search', ['substring' => $name, 'results' => $results]);
    }
}
