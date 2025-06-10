<div>
    <div class="form-floating mb-3">
        <input class="form-control" id="filmTitle" type="text" wire:keydown="search" wire:model="query"  placeholder="Suche">
        <label for="filmTitle">Filmtitel</label>
    </div>

    @foreach($searchResults as $result)
        <ul>
            <li>{{ $result['title'] }}</li>
        </ul>
    @endforeach
</div>
