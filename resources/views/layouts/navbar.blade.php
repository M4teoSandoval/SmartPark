<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo y nombre -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="SmartPark" width="50" class="me-2">
            <span class="fw-bold" style="color: #1D457D;">Smart<span style="color: #2CA6D0;">Park</span></span>
        </a>

        <!-- Menú -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link fw-bold text-success" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-success" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-success" href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
