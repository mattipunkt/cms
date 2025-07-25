<x-layout>
    <div class="d-flex justify-content-between">
        <h2>Edit poster: <b>{{ $movie->title}}</b></h2>
        <form action="/movies/{{ $movie->id }}/edit/poster/man" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <input name="image" class="form-control form-control-sm" id="manFile" type="file">
                <button class="btn">
                    <i class="bi bi-upload"></i>
                </button>
            </div>

        </form>
    </div>
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