<x-layout>

    <h1>Poster ändern: <b>{{ $movie->title}}</b></h1>
    <div class="row">
        @foreach ($images as $image)
        <div class="col-2">
        <form action="/movies/{{ $movie->id }}/edit/poster" method="post">
            @csrf
            <input name="cover_url" value="https://image.tmdb.org/t/p/w1280/{{ $image->file_path }}" hidden>
            <button style="border: none;" type="submit">
                <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2/{{ $image->file_path }}" style="max-height: 200px;" class="img-fluid rounded mb-2" alt="...">
            </button>
        </form>
    </div>
        @endforeach
    </div>
</x-layout>