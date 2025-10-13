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
                    <a class="nav-link" href="/planner"><i class="bi bi-calendar4-range"></i> Program-Planner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/movies"><i class="bi bi-camera-reels"></i> Films</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/locations"><i class="bi bi-geo-alt"></i> Locations</a>
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
                            Login
                        </a>
                        @endguest
                        @auth
                        <a class="dropdown-item disabled" disabled>
                            <b>Logged in as <i>{{ Auth::user()->name }}</i></b>
                        </a>
                        <a class="dropdown-item" href="/auth/logout">
                            Logout
                        </a>
                        <a class="dropdown-item" href="/auth/edit">
                            Edit Account
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
