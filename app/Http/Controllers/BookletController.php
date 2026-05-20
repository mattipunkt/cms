<?php

namespace App\Http\Controllers;

use App\Models\Booklet;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class BookletController extends Controller
{
    public function showBookletView()
    {
        return view('booklet.main', [
            "booklets" => Booklet::all()->sortByDesc('created_at'),
        ]);
    }

    public function uploadBooklet(Request $request)
    {
        $id = (string) Str::uuid();

        $relativePath = $request->file('booklet')->storeAs(
            'booklets',
            $id.'.pdf',
            'public'
        );

        $url = Storage::disk('public')->url($relativePath);

        Booklet::create([
            'name' => $request->name,
            'path' => $url,
        ]);

        return redirect('/booklets');
    }

    public function deleteBooklet(string $id) {
        Booklet::where('id', $id)->delete();
        return redirect('/booklets');
    }
}
