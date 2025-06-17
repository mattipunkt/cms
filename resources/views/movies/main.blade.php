<x-layout>
    <div class="d-flex justify-content-between">
        <h2>Movie-List</h2>
        <a href="/movies/add" role="button" class="btn btn-info">Add movie</a>
    </div>
<br>
        @forelse($movies as $movie)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $movie->image }}" class="img-fluid rounded-start" style="max-width: 200px;" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">{{ $movie->description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $movie->director }} | {{ date('Y', $movie->year) }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <i>It's oh so quiet... Try to add a movie</i>
        @endforelse
</x-layout>
