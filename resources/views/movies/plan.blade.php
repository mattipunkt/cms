<x-layout>
    <h3>{{ $movie->title }}</h3>
    <br>
        <ul class="list-group list-group-flush">

    @foreach ($showtimes as $showtime)
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                
                <div>
                    {{ $showtime->time }}
                @if ($showtime->subtitle)
                    <span class="badge text-bg-warning">{{ $showtime->subtitle }}</span>
                @endif
                @if ($showtime->location)
                    <span class="badge text-bg-primary">{{ $showtime->location->name }}</span>
                @endif
                @if ($showtime->language)
                    <span class="badge text-bg-secondary">{{ $showtime->language }}</span>
                @endif
                @if ($showtime->event)
                    <span class="badge text-bg-success">{{ $showtime->event->name }}</span>
                @endif
                </div>
                <div class="">

                </div>
            </div>
        </li>
    @endforeach
        </ul>


</x-layout>