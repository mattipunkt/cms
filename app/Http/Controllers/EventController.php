<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showEvents()
        {
            return view('events.main', [
                'events' => Event::all(),
            ]);
        }

    public function addEvent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
        Event::create($validated);
        return redirect('/events');
    }

    public function deleteEvent(string $id)
    {
        Event::where('id', $id)->delete();
        return redirect('/events');
    }
}
