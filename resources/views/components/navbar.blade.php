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
                @auth
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
                <li class="nav-item">
                    <a class="nav-link" href="/booklets"><i class="bi bi-book"></i> {{ __('lines.booklets') }}</a>
                </li>
                    @endauth
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    @guest
                    <a class="nav-link" href="/auth/login">
                        <i class="bi bi-door-open"> </i>  {{ __('lines.login') }}
                    </a>
                    @endguest
                    @auth
                    <a class="nav-link" href="/auth/logout">
                        <i class="bi bi-door-closed"> </i> {{ __('lines.logout') }}
                    </a>
                    @endauth
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
