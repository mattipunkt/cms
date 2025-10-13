<x-layout>
    <h1>
        Edit Movie: {{ $movie->title }}
    </h1>

    <h3>
        Edit images
    </h3>
    <a href="/movies/{{ $movie->id }}/edit/poster" class="btn btn-outline-info">
        Change poster
    </a>
    <a href="/movies/{{ $movie->id }}/edit/backdrop" class="btn btn-outline-info">
        Change full-size background
    </a>

    <h3 class="mt-3">
        Edit metadata
    </h3>
    <form method="post" action="/movies/{{ $movie->id }}/edit">
        @csrf
        <div class="form-floating mb-3">
            <input name="title" type="text" class="form-control" id="title" placeholder="Like a Complete Unknown..." value="{{ $movie->title }}">
            <label for="title">Title</label>
        </div>
        <div class="form-floating mb-3">
            <input name="year" id="year" class="form-control" type="number" value="{{ date('Y', $movie->year) }}"/>
            <label for="year">Release-Year</label>
        </div>
        <div class="form-floating mb-3">
            <input name="director" type="text" class="form-control" id="director" placeholder="Who directed it???" value="{{ $movie->director }}">
            <label for="director">Director</label>
        </div>
        <div class="form-floating mb-3">
            <input name="actors" type="text" class="form-control" id="actors" placeholder="Who played it???" value="{{ $movie->actors }}">
            <label for="actors">Actors</label>
        </div>
        <div class="form-floating mb-3">
            <input name="genre" type="text" class="form-control" id="genre" placeholder="Choose!" value="{{ $movie->genre }}">
            <label for="genre">Genre</label>
        </div>
        <div class="form-floating mb-3">
            <input name="country" type="text" class="form-control" id="country" placeholder="Where was it made?" value="{{ $movie->country }}">
            <label for="country">Country (Origin)</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="description" type="text" class="form-control" id="description" style="height:200px" value="{{ $movie->description }}">{{ $movie->description }}</textarea>
            <label for="description">Description/Outline</label>
        </div>
        <div class="form-floating mb-3">
            <input name="trailer_url" type="text" class="form-control" id="trailer_url" placeholder="Where was it made?" value="{{ $movie->trailer_url }}">
            <label for="trailer_url">Trailer-URL</label>
        </div>
        <div class="form-floating mb-3">
            <input name="runtime" type="number" class="form-control" id="runtime" value="{{ $movie->runtime }}">
            <label for="runtime">Runtime</label>
        </div>
        <button class="btn btn-info w-100" type="submit">
            Save!
        </button>

    </form>
<br><br>
</x-layout>
