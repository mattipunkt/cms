<x-layout>
    <h1>
        Program planner
    </h1>
    <div>
        @foreach($movies as $movie)
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        {{ $movie->title }}
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#{{ $movie->id }}modal">Add Showtime</button>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($movie->showtimes as $showtime)
                        {{ $showtime }}
                    @endforeach
                </div>
            </div>
            <div class="modal fade" id="{{ $movie->id }}modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                                <h1 class="modal-title fs-5">Add showtime for <b>{{ $movie->title }}</b></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/planner/{{ $movie->id }}/showtime/add">
                                @csrf
                                <input class="form-control" name="time" type="datetime-local">
                                <select class="form-select mt-2" aria-label="Location">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info mt-1 align-items-end">
                                Save!
                            </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-layout>
