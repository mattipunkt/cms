<x-layout>
    <div class="d-flex justify-content-between">
        <h1>
            Events
        </h1>
        <span >
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addEventModal">
                Add new event
            </button>
        </span>
    </div>
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5">Add new event</h4>
                </div>
                <div class="modal-body">
                    <form action="/events/add" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Event name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-info">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <ul class="list-group">
    @foreach($events as $event)
            <li class="list-group-item d-flex justify-content-between">
                    {{ $event->name }}
                <span>
                        <span><a style="color: black;" class="bi bi-trash" href="/events/{{ $event->id }}/delete"></a></span>
                    </span>

            </li>
    @endforeach
    </ul>


</x-layout>
