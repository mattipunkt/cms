<x-layout>
    <h2 class="mb-4">{{ __('lines.booklets') }}</h2>
    <h4>{{ __('lines.upload_booklets') }}</h4>
    <form class="d-grid gap-2" action="/booklets/add" method="post" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-evenly gap-2">
            <input class="form-control" type="text" name="name" placeholder="{{__('lines.booklet_name')}}">
            <input class="form-control" type="file" name="booklet" placeholder="Booklet" accept=".pdf">
        </div>
        <button class="btn btn-primary w-100">{{__('lines.save')}}</button>
    </form>

    <hr>
    <h4>{{__('lines.existing_booklets')}}</h4>
    <ul class="list-group">

    @foreach($booklets as $booklet)
        <li class="list-group-item d-flex justify-content-between align-items-center" >
            <div>
                {{ $booklet->name }}
            </div>
            <div class="d-flex gap-4">
                <a href="{{ $booklet->path }}" target="_blank" class=""><i class="bi bi-download"></i></a>

                <a href="/booklets/delete/{{ $booklet->id }}" class=""><i class="bi bi-trash"></i></a>
            </div>
        </li>
    @endforeach
    </ul>


</x-layout>
