<x-layout>
    <h1>
        Program planner
    </h1>
    <div>
        @foreach($movies as $movie)
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ $movie->title }}
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-info">Add Showtime</button>
                    </div>
                </div>
                <div class="card-body">
                    {{ $movie->showtimes }}
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
