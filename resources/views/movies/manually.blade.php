<x-layout>
    <h1>
        Manually add movie
    </h1>
    <h3 class="mt-3">
        Edit metadata
    </h3>
    <form method="post" action="/movies/add/man">
        @csrf
        <div class="form-floating mb-3">
            <input name="title" type="text" class="form-control" id="title" placeholder="Like a Complete Unknown...">
            <label for="title">Title</label>
        </div>
        <div class="form-floating mb-3">
            <input name="year" id="year" class="form-control" type="number"/>
            <label for="year">Release-Year</label>
        </div>
        <div class="form-floating mb-3">
            <input name="director" type="text" class="form-control" id="director" placeholder="Who directed it???" >
            <label for="director">Director</label>
        </div>
        <div class="form-floating mb-3">
            <input name="actors" type="text" class="form-control" id="actors" placeholder="Who played it???" >
            <label for="actors">Actors</label>
        </div>
        <div class="form-floating mb-3">
            <input name="genre" type="text" class="form-control" id="genre" placeholder="Choose!">
            <label for="genre">Genre</label>
        </div>
        <div class="form-floating mb-3">
            <input name="country" type="text" class="form-control" id="country" placeholder="Where was it made?">
            <label for="country">Country (Origin)</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="description" type="text" class="form-control" id="description" style="height:200px"></textarea>
            <label for="description">Description/Outline</label>
        </div>
        <div class="form-floating mb-3">
            <input name="trailer_url" type="text" class="form-control" id="trailer_url" placeholder="Where was it made?">
            <label for="trailer_url">Trailer-URL</label>
        </div>
        <div class="form-floating mb-3">
            <input name="runtime" type="number" class="form-control" id="runtime">
            <label for="runtime">Runtime</label>
        </div>
        <button class="btn btn-info w-100" type="submit">
            Save!
        </button>

    </form>
<br><br>
</x-layout>
