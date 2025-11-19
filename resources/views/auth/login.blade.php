<x-layout>
    <h1>
        {{ __('lines.login') }}
    </h1>
    <br>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> {{ $error }}
            </div>
        @endforeach
    @endif
    <form action="/auth/login" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder=""
            />
            <label for="email">{{ __('lines.mail')  }}</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder=""
            />
            <label for="password">{{ __('lines.password') }}</label>
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            {{ __('lines.login') }}
        </button>

    </form>
</x-layout>
