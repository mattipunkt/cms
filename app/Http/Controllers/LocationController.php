<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function showLocations() {
        return view('location.main', [
            "locations" => Location::all()
        ]);
    }
}
