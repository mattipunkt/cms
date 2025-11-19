<x-layout>
<h1>{{ __('lines.addlocation') }}</h1>
    <form action="/locations/add" method="POST">
        @csrf
        <div class="form-floating mb-3 mt-3">
            <input name="name" type="text" class="form-control" id="name" placeholder="{{ __('lines.venuename') }}" value="">
            <label for="name">{{ __('lines.venuename') }}</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input name="address" type="text" class="form-control" id="address" placeholder="{{ __('lines.venueaddess') }}" value="">
            <label for="adress">{{ __('lines.venueaddress') }} (optional)</label>
        </div>
        <button type="submit" class="btn btn-info">
            {{ __('lines.save') }}
        </button>


    </form>
</x-layout>
