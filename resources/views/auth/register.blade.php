<x-layout>
    <h1>
        {{ __('lines.register') }}
    </h1>
    <br>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> {{ $error }}
            </div>
        @endforeach
    @endif
    <form action="/auth/register" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                name="first_name"
                id="first_name"
                placeholder=""
                required
            />
            <label for="first_name">{{ __('lines.first_name') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                placeholder=""
                required
            />
            <label for="name">{{ __('lines.username') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder=""
                required
            />
            <label for="email">{{ __('lines.mail') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder=""
                required
            />
            <label for="password">{{ __('lines.password') }}</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="password"
                class="form-control"
                name="password_confirmation"
                id="password_confirmation"
                placeholder=""
                required
            />
            <label for="password_confirmation">{{ __('lines.repeat') }}</label>
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            {{ __('lines.register') }}
        </button>

    </form>


</x-layout>
