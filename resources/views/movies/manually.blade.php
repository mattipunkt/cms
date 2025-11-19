<x-layout>
    <h1>
        {{ __('lines.manual_movie') }}
    </h1>
    <h3 class="mt-3">
        {{ __('lines.edit_metadata') }}
    </h3>
    <form method="post" action="/movies/add/man">
        @csrf
        <div class="form-floating mb-3">
            <input name="title" type="text" class="form-control" id="title" placeholder="Like a Complete Unknown...">
            <label for="title">{{ __('lines.title') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="year" id="year" class="form-control" type="number"/>
            <label for="year">{{ __('lines.release_year') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="director" type="text" class="form-control" id="director" placeholder="Who directed it???" >
            <label for="director">{{ __('lines.director') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="actors" type="text" class="form-control" id="actors" placeholder="Who played it???" >
            <label for="actors">{{ __('lines.actors') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="genre" type="text" class="form-control" id="genre" placeholder="Choose!">
            <label for="genre">{{ __('lines.genre') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="country" type="text" class="form-control" id="country" placeholder="Where was it made?">
            <label for="country">{{ __('lines.country') }}</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="description" type="text" class="form-control" id="description" style="height:200px"></textarea>
            <label for="description">{{ __('lines.description') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="trailer_url" type="text" class="form-control" id="trailer_url" placeholder="Where was it made?">
            <label for="trailer_url">{{ __('lines.trailer_url') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input name="runtime" type="number" class="form-control" id="runtime">
            <label for="runtime">{{ __('lines.runtime') }}</label>
        </div>
        <button class="btn btn-info w-100" type="submit">
            {{ __('lines.save') }}
        </button>

    </form>
<br><br>
</x-layout>
