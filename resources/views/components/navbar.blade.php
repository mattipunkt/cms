<nav
    class="navbar navbar-expand-sm navbar-dark bg-dark mb-3"
>
    <div class="container">
        <a class="navbar-brand" href="/">CMS</a>
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar"
            aria-controls="navbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/planner"><i class="bi bi-calendar4-range"></i> {{ __('lines.program_planner') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/movies"><i class="bi bi-camera-reels"></i> {{ __('lines.film_list') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/locations"><i class="bi bi-geo-alt"></i> {{ __('lines.locations') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/events"><i class="bi bi-balloon"></i> {{ __('lines.events') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        @guest
                        <a class="dropdown-item" href="/auth/login">
                            {{ __('lines.login') }}
                        </a>
                        @endguest
                        @auth
                        <a class="dropdown-item disabled" disabled>
                            <b>{{ __('lines.loggedinas') }} <i>{{ Auth::user()->name }}</i></b>
                        </a>
                        <a class="dropdown-item" href="/auth/logout">
                            {{ __('lines.logout') }}
                        </a>
                        @endauth
                    </div>
                </li>
                <li class="nav-item mt-sm-2">
                    <span class="badge rounded-pill text-bg-info">
                        <a href="https://github.com/mattipunkt/cms" target="_blank" class="text-decoration-none text-black  ">
                            <i class="bi bi-github"></i> mattipunkt/cms
                        </a>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</nav>
