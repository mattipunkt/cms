<x-layout>
    <div class="d-flex justify-content-between">
            <h1>Locations</h1>
            <span><a href="/locations/add" role="button" class="btn btn-info">Add location</a></span>
    </div>
    @foreach ($locations as $location)
        
    @endforeach
</x-layout>