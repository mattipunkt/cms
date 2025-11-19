<x-layout>
    <h1>
        {{ __('lines.edit_movie') }} {{ $movie->title }}
    </h1>

    <h3>
        {{ __('lines.edit_images') }}
    </h3>
    <a href="/movies/{{ $movie->id }}/edit/poster" class="btn btn-outline-info">
        {{ __('lines.change_poster') }}
    </a>
    <a href="/movies/{{ $movie->id }}/edit/backdrop" class="btn btn-outline-info">
        {{ __('lines.change_fullsize_background') }}
    </a>

    <h3 class="mt-3">
        {{ __('lines.edit_metadata') }}
    </h3>
    <form method="post" action="/movies/{{ $movie->id }}/edit">
        @csrf
        <div class="form-floating mb-3">
            <input name="title" type="text" class="form-control" id="title" placeholder="Like a Complete Unknown..." value="{{ $movie->title }}">
            <label for="title">{{ __('lines.title') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="year" id="year" class="form-control" type="number" value="{{ date('Y', $movie->year) }}"/>
            <label for="year">{{ __('lines.release_year') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="director" type="text" class="form-control" id="director" placeholder="Who directed it???" value="{{ $movie->director }}">
            <label for="director">{{ __('lines.director') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="actors" type="text" class="form-control" id="actors" placeholder="Who played it???" value="{{ $movie->actors }}">
            <label for="actors">{{ __('lines.actors') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="genre" type="text" class="form-control" id="genre" placeholder="Choose!" value="{{ $movie->genre }}">
            <label for="genre">{{ __('lines.genre') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="country" type="text" class="form-control" id="country" placeholder="Where was it made?" value="{{ $movie->country }}">
            <label for="country">{{ __('lines.country') }}</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="description" type="text" class="form-control" id="description" style="height:200px" value="{{ $movie->description }}">{{ $movie->description }}</textarea>
            <label for="description">{{ __('lines.description') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="trailer_url" type="text" class="form-control" id="trailer_url" placeholder="Where was it made?" value="{{ $movie->trailer_url }}">
            <label for="trailer_url">{{ __('lines.trailer_url') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="runtime" type="number" class="form-control" id="runtime" value="{{ $movie->runtime }}">
            <label for="runtime">{{ __('lines.runtime') }}</label>
        </div>
        <button class="btn btn-info w-100" type="submit">
            {{ __('lines.save') }}
        </button>

    </form>
<br><br>
</x-layout>
