<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function getDash(){
        $dash = [];
        $dash['members'] =[
            'count' => User::count(),
            'bestMember' => User::get()->sortByDesc('projectCount')->first(),
        ];
        $dash['projects'] =[
            'count' => Project::count(),
            'lastProject' => Project::orderBy('created_at', 'desc')->first(),
            'pendingCount' => Project::where('finished', false)->count(),
            'pendingProjects' => Project::where('finished', false)->get(),
        ];
        return response()->json($dash);
    }
}
