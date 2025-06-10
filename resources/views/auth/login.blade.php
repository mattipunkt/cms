<x-layout>
    <h1>
        Login
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
            <label for="email">E-Mail-Address</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder=""
            />
            <label for="password">Password</label>
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            Login
        </button>
        
    </form>
</x-layout>