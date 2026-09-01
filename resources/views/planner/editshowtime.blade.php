<div>
    <h4>{{ $showtime->movie->title }}</h4>

    <div class="d-flex gap-2">
        <a href="/planner/showtime/{{ $showtime->id }}/remove" class="btn btn-danger"><i class="bi bi-trash">
            </i>Löschen</a>
    </div>
</div>