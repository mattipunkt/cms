<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Movie;
use Illuminate\Http\Request;

class ProgramPlannerController extends Controller
{
    //
    public function showPlanner()
    {
        return view('planner.main', [
            'movies' => Movie::all(),
            'locations' => Location::all()
        ]);
    }
}
