<div>
    <h4>{{ $showtime->movie->title }}</h4>
    <form method="POST" action="/planner/showtime/{{ $showtime->id }}/edit">
    @csrf
    <input
        class="form-control mt-2"
        value="{{ $showtime->time->format('Y-m-d\TH:i') }}"
        name="time"
        type="datetime-local"
        required
    >
    <input class="form-control mt-2" name="subtitle" type="text"
        placeholder="{{ __('lines.subtitle') }} (e.g. Premiere)" value="{{ $showtime->subtitle }}">
    <input class="form-control mt-2" name="language" type="text" placeholder="{{ __('lines.language') }} (e.g. OV)" value="{{ $showtime->language }}">
    <select class="form-select mt-2" name="location_id" aria-label="{{ __('lines.location') }}" required>
        @foreach($locations as $location)
            <option value="{{ $location->id }}"
                @selected($location->id == $showtime->location_id)>
                {{ $location->name }}
            </option>
        @endforeach
    </select>
        <select class="form-select mt-2" name="event_id">
            <option value="" @selected(is_null($showtime->event_id))>
                {{ __('lines.no_event') }}
            </option>

            @foreach($events as $event)
                <option value="{{ $event->id }}"
                    @selected($event->id == $showtime->event_id)>
                    {{ $event->name }}
                </option>
            @endforeach
        </select>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-info mt-3">
            {{ __('lines.save') }}
        </button>
    </div>
</form>

    <div class="d-flex gap-2">
        <a href="/planner/showtime/{{ $showtime->id }}/remove" class="btn btn-danger"><i class="bi bi-trash">
            </i>Löschen</a>
    </div>
</div>
