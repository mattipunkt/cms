<div>
    <div class="form-floating mb-3">
        <input class="form-control" id="filmTitle" type="text" wire:keydown="search" wire:model="query"  placeholder="Suche">
        <label for="filmTitle">Filmtitel</label>
    </div>
    <div class="list-group">
    @foreach($searchResults as $result)
            <a href="/movies/add?tmdb_id={{ $result['id'] }}" class="list-group-item list-group-item-actions">{{ $result['title'] }}</a>
    @endforeach
    </div>

</div>
