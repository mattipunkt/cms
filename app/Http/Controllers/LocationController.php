<?php

namespace App\Http\Controllers;

use App\Models\Location;

class LocationController extends Controller
{
    public function showLocations()
    {
        return view('location.main', [
            'locations' => Location::all(),
        ]);
    }

    public function addLocation()
    {
        return view('location.add');
    }

    public function addLocationPost()
    {
        $validated = request()->validate([
            'name' => 'required|max:255',
            'address' => 'max:255',
        ]);

        Location::create($validated);
        return redirect('/locations');
    }

    public function deleteLocation(string $id)
    {
        Location::where('id', $id)->delete();
        return redirect('/locations');
    }
}
