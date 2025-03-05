<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo + Nom -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="LaraLink Logo" width="40" class="me-2">
            <span class="fw-bold">{{ config('app.name', 'LaraLink') }}</span>
        </a>

        <!-- Bouton Burger (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <!-- Lien Accueil -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-bold' : '' }}" href="{{ url('/') }}">
                        Accueil
                    </a>
                </li>

                @auth
                    <!-- Lien Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <!-- Nom utilisateur -->
                    <li class="nav-item">
                        <span class="nav-link fw-bold">👤 {{ auth()->user()->name }}</span>
                    </li>

                    <!-- Bouton Déconnexion -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Déconnexion</button>
                        </form>
                    </li>
                @else
                    <!-- Liens Connexion & Inscription -->
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('register') }}">S'inscrire</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
