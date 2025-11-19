<x-layout>
    <div class="d-flex justify-content-between">
            <h1>{{ __('lines.locations') }}</h1>
            <span><a href="/locations/add" role="button" class="btn btn-info">{{ __('lines.new_location') }}</a></span>
    </div>
    <ul class="list-group">
    @foreach ($locations as $location)

                <li class="list-group-item d-flex justify-content-between">
                    <a href="/locations/{{ $location->id }}" class="link-body-emphasis link-offset-2 link-underline link-underline-opacity-0">
                        {{ $location->name }}
                        @if($location->address)
                        <i>({{ $location->address }})</i>
                        @endif
                    </a>
                    <span>
                        <span><a style="color: black;" class="bi bi-trash" href="/locations/{{ $location->id }}/delete"></a></span>
                    </span>

                </li>
    @endforeach
</x-layout>
