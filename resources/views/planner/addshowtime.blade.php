<form method="POST" action="/planner/showtime/add">
    @csrf
    <select class="form-select mt-2" name="movie_id" aria-label="{{ __('lines.movie') }}" required>
        @foreach($movies as $movie)
            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
        @endforeach
    </select>
    <input class="form-control mt-2" value="{{ $date }}T00:00" name="time" type="datetime-local" required>
    <input class="form-control mt-2" name="subtitle" type="text"
        placeholder="{{ __('lines.subtitle') }} (e.g. Premiere)">
    <input class="form-control mt-2" name="language" type="text" placeholder="{{ __('lines.language') }} (e.g. OV)">
    <select class="form-select mt-2" name="location_id" aria-label="{{ __('lines.location') }}" required>
        @foreach($locations as $location)
            <option value="{{ $location->id }}">{{ $location->name }}</option>
        @endforeach
    </select>
    <select class="form-select mt-2" name="event_id" aria-label="{{ __('lines.event') }} (optional)">
        <option value="">{{ __('lines.no_event') }}</option>
        @foreach($events as $event)
            <option value="{{ $event->id }}">{{ $event->name }}</option>
        @endforeach
    </select>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-info mt-3">
            {{ __('lines.save') }}
        </button>
    </div>
</form>