<x-layout>
    <h1 class="d-flex justify-content-between">
        <div>{{ __('lines.program_planner') }}</div>
        <div>
            <a href="/planner?startDate={{ $lastWeekDay }}"
                class="link-secondary link-underline link-underline-opacity-0">
                <i class="bi bi-arrow-left"></i>
            </a>
            <a href="/planner?startDate={{ $nextWeekDay }}"
                class="link-secondary link-underline link-underline-opacity-0">
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </h1>

    <hr>

    <div class="row">
        @foreach ($result as $res)
            <div class="col col-7th border-right">
                <h5 class="text-center">{{ $res['date'] }}</h5>
                <div class="card">
                    <button class="btn btn-info  text-center" data-bs-toggle="modal" data-bs-target="#showtimeModal"
                        data-showtime-url="{{ url('/planner/showtime/add?date='.$res['date']) }}">
                        <i class="bi bi-plus fs-4"></i>
                    </button>
                </div>
                @foreach ($res['showtimes'] as $st)
                    <button type="button" class="btn p-0 w-100 text-start border-0 bg-transparent" data-bs-toggle="modal"
                        data-bs-target="#showtimeModal" data-showtime-url="{{ url('/planner/showtime/view/'.$st->id) }}"
                        data-showtime-title="{{ optional($st->movie)->title }}">
                        <div class="card my-2 shadow-sm">
                            <div class="card-body p-2">
                                <b>{{ $st->time->format('H:i') }}</b><br>
                                <span>{{ optional($st->movie)->title }}</span>
                                <span class=" badge text-bg-warning">{{ optional($st->location)->name }}</span>

                                @if ($st->event)
                                    <span class="badge text-bg-danger">{{ optional($st->event)->name }}</span>
                                @endif
                            </div>
                        </div>
                    </button>
                @endforeach


            </div>
        @endforeach
    </div>

    <div class="modal fade" id="showtimeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showtimeModalLabel">Spielzeit bearbeiten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                </div>
                <div class="modal-body" id="showtimeModalBody">
                    <div class="text-center text-muted py-5">
                        Lade...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('showtimeModal').addEventListener('show.bs.modal', function (event) {
            const trigger = event.relatedTarget;
            if (!trigger) {
                return;
            }

            const url = trigger.getAttribute('data-showtime-url');
            const title = trigger.getAttribute('data-showtime-title') || 'Showtime';

            // document.getElementById('showtimeModalLabel').textContent = title;

            const body = document.getElementById('showtimeModalBody');
            body.innerHTML = '<div class="text-center text-muted py-5">Lade...</div>';

            htmx.ajax('GET', url, body);
        });

        document.getElementById('showtimeModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('showtimeModalBody').innerHTML = '<div class="text-center text-muted py-5">Lade...</div>';
        });
    </script>
</x-layout>