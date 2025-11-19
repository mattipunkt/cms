<div>
    <div class="form-floating mb-3">
        <input class="form-control" id="filmTitle" type="text" wire:keydown="search" wire:model="query"  placeholder="{{ __('lines.search') }}">
        <label for="filmTitle">{{ __('lines.searchbytitle') }}</label>
    </div>
    @if (!$searchResults)
        <span><i>{{ __('lines.youcanalso') }} <a href="/movies/add/man">{{ __('lines.manuallyaddamovie') }}...</a></i></span>
    @endif
    <div class="list-group">
    @foreach($searchResults as $result)
            <a href="/movies/add?tmdb_id={{ $result['id'] }}" class="list-group-item list-group-item-actions">{{ $result['title'] }} <i>({{ substr($result['year'], 0, 4) }})</i></a>
    @endforeach
    </div>

</div>
