<x-layout>
    <div class="d-flex justify-content-between">
        <h2>{{ __('lines.editbackdrop') }}: <b>{{ $movie->title}}</b></h2>
        <form action="/movies/{{ $movie->id }}/edit/backdrop/man" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <input name="image" class="form-control form-control-sm" id="manFile" type="file">
                <button class="btn">
                    <i class="bi bi-upload"></i>
                </button>
            </div>

        </form>
        <div>
            <a class="btn btn-danger" href="/movies/{{ $movie->id }}/edit/backdrop/remove"><i class="bi bi-trash"> </i>{{ __('lines.removebackdrop') }}</a>
        </div>
    </div>
    <div class="row">
        @foreach ($images as $image)
        <div class="col-4">
        <form action="/movies/{{ $movie->id }}/edit/backdrop" method="post">
            @csrf
            <input name="cover_url" value="https://image.tmdb.org/t/p/original/{{ $image->file_path }}" hidden>
            <button class="btn" style="border: none;" type="submit">
                <img src="https://image.tmdb.org/t/p/w1066_and_h600_bestv2/{{ $image->file_path }}" style="max-height: 200px;" class="img-fluid rounded mb-2" alt="...">
            </button>
        </form>
    </div>
        @endforeach
    </div>
</x-layout>
