<x-layout>
    <h2>Movie-List</h2>
        @forelse($movies as $movie)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <i>It's oh so quiet... Try to add a movie</i>
        @endforelse
</x-layout>
