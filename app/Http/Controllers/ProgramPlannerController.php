<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ProgramPlannerController extends Controller
{
    //
    public function showPlanner(Request $request)
    {
        $startDate = $request->input("startDate");
        if ($startDate !== null) {
            $weekStart = Carbon::parse($startDate)->startOfWeek();
            $weekEnd = Carbon::parse($startDate)->endOfWeek();
        } else {
            $weekStart = Carbon::now()->startOfWeek();
            $weekEnd = Carbon::now()->endOfWeek();
        }
        $showtimesByDay = Showtime::query()
            ->with(['movie', 'location', 'event'])
            ->whereBetween('time', [$weekStart->startOfDay(), $weekEnd->endOfDay()])
            ->orderBy('time')
            ->get()
            ->groupBy(fn (Showtime $showtime) => $showtime->time->toDateString());

        $result = collect(CarbonPeriod::create($weekStart, '1 day', $weekEnd))
            ->map(fn (Carbon $day) => [
                'date' => $day->toDateString(),
                'showtimes' => $showtimesByDay->get($day->toDateString(), collect())->values(),
            ])
            ->values();
        return view('planner.main', [
            'result' => $result,
            'nextWeekDay' => $weekEnd->addDay()->toDateString(),
            'lastWeekDay' => $weekStart->previous()->toDateString(),
            'locations' => Location::all(),
            'events' => Event::all()
        ]);
    }

    public function editShowtime(string $id) {
        $showtime = Showtime::find($id);
        return view('planner.editshowtime', [
                'showtime' => $showtime,
                'locations' => Location::all(),
                'events' => Event::all()
            ]
        );
    }

    public function showShowtimeAdder(Request $request) {
        return view('planner.addshowtime', [
            'locations'=> Location::all(),
            'events'=> Event::all(),
            'movies' => Movie::all(),
            'date' => $request->input('date'),
        ]);
    }



    public function addShowtime()
    {
        $validated = request()->validate([
            // HTML datetime-local sends value like 2025-10-10T10:00
            'time' => 'required|date_format:Y-m-d\TH:i',
            'location_id' => 'required|exists:locations,id',
            'event_id' => 'exists:events,id|nullable',
            'movie_id' => 'required|exists:movies,id',
            'language' => 'max:255',
            'subtitle' => 'max:255',
        ]);
        $movie = Movie::where('id', $validated['movie_id'])->firstOrFail();
        $movie->showtimes()->create($validated);

        return redirect('/planner');
    }


    public function editShowtimePost(string $id) 
    {
            $validated = request()->validate([
            // HTML datetime-local sends value like 2025-10-10T10:00
            'time' => 'required|date_format:Y-m-d\TH:i',
            'location_id' => 'required|exists:locations,id',
            'event_id' => 'exists:events,id|nullable',
            'language' => 'max:255',
            'subtitle' => 'max:255',
        ]);
        $showtime = Showtime::where('id', $id)->firstOrFail();
        $showtime->time = $validated['time'];
        $showtime->location_id = $validated['location_id'];
        $showtime->event_id = $validated['event_id'];
        $showtime->language = $validated['language'];
        $showtime->subtitle = $validated['subtitle'];
        $showtime->save();

        return redirect('/planner');
    }

    public function removeShowtime(string $id)
    {
        $showtime = Showtime::where('id', $id)->firstOrFail();
        $date = Carbon::parse($showtime->time);
        $showtime->delete();
       
        return redirect('/planner?startDate='. $date->toDateString());
    }
}
