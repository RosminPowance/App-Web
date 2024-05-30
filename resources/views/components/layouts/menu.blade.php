<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" x-data>
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false"
        aria-label="Toggle Navigation">
        <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
    </button>
    <a class="navbar-brand me-1 me-sm-3" href="#">
        <div class="d-flex align-items-center">
            <img class="me-2" src="{{ asset('assets/images/mainLogo.gif') }}" alt="" width="40" />
        </div>
    </a>
    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link link-600 fw-medium" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" id="dashboards">Production</a>
                <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0" aria-labelledby="dashboards">
                    <div class="bg-white dark__bg-1000 rounded-3 py-2">
                        <a class="dropdown-item link-600 fw-medium" wire:navigate href="{{ route('production.long-term') }}">Production Long Term</a>
                    </div>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" id="consolidated">Consolidated Surplus UW</a>
                <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0"
                    aria-labelledby="consolidated">
                    <div class="bg-white dark__bg-1000 rounded-3 py-2">
                        <a class="dropdown-item link-600 fw-medium" href="index-2.html">Long Term</a>
                        <a class="dropdown-item link-600 fw-medium" href="dashboard/analytics.html">Year</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script data-navigate-once>
    var navbarPosition = localStorage.getItem("navbarPosition");
    var navbarTop = document.querySelector(
        "[data-layout] .navbar-top:not([data-double-top-nav"
    );
    navbarTop.removeAttribute("style");
</script>
