<form id="add-showtime-form" method="POST" action="/planner/showtime/add">
    @csrf
    <div class="mt-2">
        <label class="visually-hidden" for="movie-search">{{ __('lines.searchbytitle') }}</label>
        <input class="form-control movie-search" id="movie-search" type="search"
            placeholder="{{ __('lines.searchbytitle') }}" autocomplete="off">
        <select class="form-select mt-2" name="movie_id" aria-label="{{ __('lines.movie') }}" multiple required>
            @foreach($movies as $movie)
                <option value="{{ $movie->id }}" @selected($loop->first)>{{ $movie->title }}</option>
            @endforeach
        </select>
        <div class="form-text movie-search-empty d-none" role="status">
            {{ __('lines.no_movies') }}
        </div>
    </div>
    <input class="form-control mt-4" value="{{ $date }}T00:00" name="time" type="datetime-local" required>
    <input class="form-control mt-4" name="subtitle" type="text"
        placeholder="{{ __('lines.subtitle') }} (e.g. Premiere)">
    <input class="form-control mt-2" name="language" type="text" placeholder="{{ __('lines.language') }} (e.g. OV)">
    <select class="form-select mt-4" name="location_id" aria-label="{{ __('lines.location') }}" required>
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
    <input class="form-control mt-2" name="ticket_url" type="text" placeholder="{{ __('lines.ticket_url') }} ({{ __('lines.optional') }})">

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-info mt-3">
            {{ __('lines.save') }}
        </button>
    </div>
</form>

<script>
    const addShowtimeForm = document.getElementById('add-showtime-form');

    addShowtimeForm.addEventListener('keydown', function (event) {
        if (event.key !== 'Enter' || event.target.matches('button')) {
            return;
        }

        event.preventDefault();
        addShowtimeForm.requestSubmit();
    });

    document.querySelectorAll('.movie-search').forEach(function (searchInput) {
        const movieSelect = searchInput.nextElementSibling;
        const emptyMessage = movieSelect.nextElementSibling;
        let previouslySelectedMovies = new Set(
            Array.from(movieSelect.selectedOptions).map(function (movieOption) {
                return movieOption.value;
            })
        );

        movieSelect.addEventListener('change', function () {
            const selectedMovies = Array.from(movieSelect.selectedOptions);
            const newlySelectedMovie = selectedMovies.find(function (movieOption) {
                return !previouslySelectedMovies.has(movieOption.value);
            });

            if (selectedMovies.length > 1) {
                const movieToKeep = newlySelectedMovie || selectedMovies[selectedMovies.length - 1];

                selectedMovies.forEach(function (movieOption) {
                    movieOption.selected = movieOption === movieToKeep;
                });
            }

            previouslySelectedMovies = new Set(
                Array.from(movieSelect.selectedOptions).map(function (movieOption) {
                    return movieOption.value;
                })
            );
        });

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.trim().toLocaleLowerCase();
            let visibleMovies = 0;

            Array.from(movieSelect.options).forEach(function (movieOption) {
                const matches = movieOption.text.toLocaleLowerCase().includes(query);
                movieOption.hidden = !matches;
                visibleMovies += matches ? 1 : 0;
            });

            emptyMessage.classList.toggle('d-none', visibleMovies > 0);
        });
    });
</script>