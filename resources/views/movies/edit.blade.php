<x-layout>
    <h1>
        Edit Movie: {{ $movie->title }}
    </h1>

    <form method="post" action="/movies/{{ $movie->id }}/edit">
        @csrf

    </form>

</x-layout>
