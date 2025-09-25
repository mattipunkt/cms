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

    public function addShowtime(string $id)
    {
        $validated = request()->validate([
            'time' => 'required|date_format:Y-m-d H:i',
            'location' => 'required|exists:locations,id',
        ]);
        $movie = Movie::where('id', $id)->first();
        $movie->showtimes()->create($validated);
        return redirect('/planner');
    }
}
