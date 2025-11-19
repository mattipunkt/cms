<x-layout>
    <h1>
        {{ __('lines.program_planner') }}
    </h1>
    <div>
        @foreach($movies as $movie)
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        {{ $movie->title }}
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#{{ $movie->id }}modal">{{ __('lines.add_showtime') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($movie->upcomingShowtimes as $showtime)
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <b>{{ $showtime->time->format("d.m.Y, H:i")}}</b> <br>
                                    <small>{{ $showtime->location->name }}</small>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="/planner/showtime/{{ $showtime->id }}/remove">
                                            {{ __('lines.delete') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="modal fade" id="{{ $movie->id }}modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                                <h1 class="modal-title fs-5">{{ __('lines.add_showtime_for') }} <b>{{ $movie->title }}</b></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('lines.close') }}"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/planner/{{ $movie->id }}/showtime/add">
                                @csrf
                                <input class="form-control" name="time" type="datetime-local" required>
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
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-layout>
