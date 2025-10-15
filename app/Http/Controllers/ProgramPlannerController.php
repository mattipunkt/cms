<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Movie;
use App\Models\Showtime;

class ProgramPlannerController extends Controller
{
    //
    public function showPlanner()
    {
        return view('planner.main', [
            'movies' => Movie::all(),
            'locations' => Location::all(),
            'events' => Event::all()
        ]);
    }

    public function addShowtime(string $id)
    {
        $validated = request()->validate([
            // HTML datetime-local sends value like 2025-10-10T10:00
            'time' => 'required|date_format:Y-m-d\TH:i',
            'location_id' => 'required|exists:locations,id',
            'event_id' => 'exists:events,id|nullable',
            'language' => 'max:255'
        ]);
        $movie = Movie::where('id', $id)->firstOrFail();
        $movie->showtimes()->create($validated);

        return redirect('/planner');
    }

    public function removeShowtime(string $id)
    {
        $showtime = Showtime::where('id', $id)->firstOrFail();
        $showtime->delete();

        return redirect('/planner');
    }
}
