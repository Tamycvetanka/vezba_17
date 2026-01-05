<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fa-solid fa-cloud-sun me-2"></i> Weather Admin
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.forecasts.index') }}">
                        <i class="fa-solid fa-list me-1"></i> Prognoze
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
