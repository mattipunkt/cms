<x-layout>
    <div class="d-flex justify-content-between">
        <h2>{{ __('lines.movie_list') }}</h2>
        <span><a href="/movies/add" role="button" class="btn btn-info">{{ __('lines.add_movie') }}</a></span>
    </div>

    <hr>
    <div class="d-flex gap-2 bg-info p-1 rounded">
        <input name="filter" class="form-control" type="text" placeholder="{{ __('lines.filter_movies') }}" />
        <button onclick="filter()" id="filter" class="btn btn-info" type="submit">{{ __('lines.filter') }}</button>
    </div>
<br>
        @forelse($movies as $movie)
            <div class="card mb-3 @if(!$movie->activation) opacity-50 @endif">
                <div class="row g-0">
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="text-uppercase">{{ $movie->subtitle }}</small>
                                    <h5 class="card-title">{{ $movie->title }}</h5>
                                </div>


                                <div class="d-flex gap-3">
                                    @if($movie->activation)
                                        <span><a style="color:black" href="/movies/{{ $movie->id }}/deactivate" class="bi bi-eye"></a></span>
                                    @else
                                        <span><a style="color:black" href="/movies/{{ $movie->id }}/activate" class="bi bi-eye-slash"></a></span>
                                    @endif
                                    <span><a style="color: black;" class="bi bi-calendar3" href="/movies/{{ $movie->id }}/plan"></a></span>
                                    <span><a style="color: black;" class="bi bi-pencil" href="/movies/{{ $movie->id }}/edit"></a></span>
                                    <span><a style="color: black;" class="bi bi-trash" href="/movies/{{ $movie->id }}/delete"></a></span>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <i>{{ __('lines.no_movies') }}</i>
        @endforelse
<script>
    function filter() {
        window.location.href = "/movies?filter=" + document.querySelector("input[name=filter]").value;
    }
</script>
</x-layout>
